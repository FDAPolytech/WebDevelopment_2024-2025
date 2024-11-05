/* global wpforms_ai_chat_element, WPFormsAIModal, wpf */

// Dynamic modules import.
Promise.all( [
	import( `./modules/api${ wpforms_ai_chat_element.min }.js` ),
	import( `./modules/helpers-text${ wpforms_ai_chat_element.min }.js` ),
	import( `./modules/helpers-choices${ wpforms_ai_chat_element.min }.js` ),
] )
	.then( ( [ apiModule, helpersText, helpersChoices ] ) => {
		window.WPFormsAi = {
			api: apiModule.default(),
			helpers: {
				text: helpersText.default,
				choices: helpersChoices.default,
			},
		};

		// Register the custom HTML element.
		customElements.define( 'wpforms-ai-chat', WPFormsAIChatHTMLElement ); // eslint-disable-line no-use-before-define
	} );

/**
 * @param this.modeStrings.learnMore
 * @param wpforms_ai_chat_element.dislike
 * @param wpforms_ai_chat_element.refresh
 * @param wpforms_ai_chat_element.confirm.refreshTitle
 * @param wpforms_ai_chat_element.confirm.refreshMessage
 */

/**
 * The WPForms AI chat.
 *
 * Custom HTML element class.
 *
 * @since 1.9.1
 */
class WPFormsAIChatHTMLElement extends HTMLElement {
	/**
	 * Element constructor.
	 *
	 * @since 1.9.1
	 */
	constructor() { // eslint-disable-line no-useless-constructor
		// Always call super first in constructor.
		super();
	}

	/**
	 * Element connected to the DOM.
	 *
	 * @since 1.9.1
	 */
	connectedCallback() {
		// Init chat properties.
		this.chatMode = this.getAttribute( 'mode' ) ?? 'text';
		this.fieldId = this.getAttribute( 'field-id' ) ?? '';
		this.modeStrings = wpforms_ai_chat_element[ this.chatMode ] ?? {};
		this.loadingState = false;

		// Init chat helpers according to the chat mode.
		this.modeHelpers = this.getHelpers( this );

		// Bail if chat mode helpers not found.
		if ( ! this.modeHelpers ) {
			console.error( `WPFormsAI error: chat mode "${ this.chatMode }" helpers not found` ); // eslint-disable-line no-console

			return;
		}

		// Render chat HTML.
		this.innerHTML = this.getInnerHTML();

		// Get chat elements.
		this.wrapper = this.querySelector( '.wpforms-ai-chat' );
		this.input = this.querySelector( '.wpforms-ai-chat-message-input input' );
		this.welcomeScreenSamplePrompts = this.querySelector( '.wpforms-ai-chat-welcome-screen-sample-prompts' );
		this.sendButton = this.querySelector( '.wpforms-ai-chat-send' );
		this.stopButton = this.querySelector( '.wpforms-ai-chat-stop' );
		this.messageList = this.querySelector( '.wpforms-ai-chat-message-list' );

		// Compact scrollbar for non-Mac devices.
		if ( ! navigator.userAgent.includes( 'Macintosh' ) ) {
			this.messageList.classList.add( 'wpforms-scrollbar-compact' );
		}

		this.events();
	}

	/**
	 * Get initial innerHTML markup.
	 *
	 * @since 1.9.1
	 *
	 * @return {string} The inner HTML markup.
	 */
	getInnerHTML() {
		return `
			<div class="wpforms-ai-chat">
				<div class="wpforms-ai-chat-message-list">
					${ this.getWelcomeScreen() }
				</div>
				<div class="wpforms-ai-chat-message-input">
					<input type="text" placeholder="${ this.modeStrings.placeholder }" />
					<button type="button" class="wpforms-ai-chat-send"></button>
					<button type="button" class="wpforms-ai-chat-stop wpforms-hidden"></button>
				</div>
			</div>
		`;
	}

	/**
	 * Get the Welcome screen HTML markup.
	 *
	 * @since 1.9.1
	 *
	 * @return {string} The spinner SVG markup.
	 */
	getWelcomeScreen() {
		const samplePrompts = this.modeStrings.samplePrompts;
		const li = [];
		let content = '';

		if ( this.modeHelpers.isWelcomeScreen() ) {
			// Render sample prompts.
			for ( const i in samplePrompts ) {
				li.push( `
				<li>
					<i class="${ samplePrompts[ i ].icon }"></i>
					<a href="#">${ samplePrompts[ i ].title }</a>
				</li>
			` );
			}

			content = `<ul class="wpforms-ai-chat-welcome-screen-sample-prompts">
						${ li.join( '' ) }
					</ul>`;
		} else {
			this.messagePreAdded = true;

			content = this.modeHelpers.getWarningMessage();
		}

		return `
			<div class="wpforms-ai-chat-message-item item-primary">
				<div class="wpforms-ai-chat-welcome-screen">
					<div class="wpforms-ai-chat-header">
						<h3 class="wpforms-ai-chat-header-title">${ this.modeStrings.title }</h3>
						<span class="wpforms-ai-chat-header-description">${ this.modeStrings.description }
							<a href="${ this.modeStrings.learnMoreUrl }" target="_blank" rel="noopener noreferrer">${ this.modeStrings.learnMore }</a>.
						</span>
					</div>
					${ content }
				</div>
			</div>
		`;
	}

	/**
	 * Get the spinner SVG image.
	 *
	 * @since 1.9.1
	 *
	 * @return {string} The spinner SVG markup.
	 */
	getSpinnerSvg() {
		return `<svg class="wpforms-ai-chat-spinner-dots" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><style>.spinner_S1WN{animation:spinner_MGfb .8s linear infinite;animation-delay:-.8s; fill: #999;}.spinner_Km9P{animation-delay:-.65s}.spinner_JApP{animation-delay:-.5s}@keyframes spinner_MGfb{93.75%,100%{opacity:.2}}</style><circle class="spinner_S1WN" cx="4" cy="12" r="3"/><circle class="spinner_S1WN spinner_Km9P" cx="12" cy="12" r="3"/><circle class="spinner_S1WN spinner_JApP" cx="20" cy="12" r="3"/></svg>`;
	}
	/**
	 * Add event listeners.
	 *
	 * @since 1.9.1
	 */
	events() {
		this.sendButton.addEventListener( 'click', this.sendMessage.bind( this ) );
		this.stopButton.addEventListener( 'click', this.stopLoading.bind( this ) );
		this.input.addEventListener( 'keyup', this.keyUp.bind( this ) );
		this.bindWelcomeScreenEvents();
	}

	/**
	 * Bind welcome screen events.
	 *
	 * @since 1.9.1
	 */
	bindWelcomeScreenEvents() {
		if ( this.welcomeScreenSamplePrompts === null ) {
			return;
		}

		// Click on the default item in the welcome screen.
		this.welcomeScreenSamplePrompts.querySelectorAll( 'li' ).forEach( ( li ) => {
			li.addEventListener( 'click', this.clickDefaultItem.bind( this ) );

			li.addEventListener( 'keydown', ( e ) => {
				if ( e.code === 'Enter' ) {
					e.preventDefault();
					this.clickDefaultItem( e );
				}
			} );
		} );
	}

	/**
	 * Keyboard `keyUp` event handler.
	 *
	 * @since 1.9.1
	 *
	 * @param {KeyboardEvent} e The keyboard event.
	 */
	keyUp( e ) {
		switch ( e.code ) {
			case 'Enter':
				e.preventDefault();
				this.sendMessage();
				break;

			case 'ArrowUp':
				this.arrowUp();
				break;

			case 'ArrowDown':
				this.arrowDown();
				break;
			default:
				// Update the chat history.
				this.history.update( { question: this.input.value } );
		}
	}

	/**
	 * Send a question message to the chat.
	 *
	 * @since 1.9.1
	 */
	sendMessage() {
		const message = this.input.value;

		if ( ! message ) {
			return;
		}

		// Fire event before sending the message.
		this.triggerEvent( 'wpformsAIChatBeforeSendMessage', { fieldId: this.fieldId } );

		this.addFirstMessagePre();
		this.welcomeScreenSamplePrompts?.remove();
		this.input.value = '';
		this.addMessage( message, true );
		this.startLoading();

		if ( message.trim() === '' ) {
			this.addEmptyResultsError();

			return;
		}

		this
			.getAiApi()
			.prompt( message, this.sessionId )
			.then( ( response ) => {
				this.addAnswer( response );
			} )
			// eslint-disable-next-line complexity
			.catch( ( error ) => {
				// Handle the rate limit error.
				if ( error.cause === 429 ) {
					this.addError(
						this.modeStrings.errors.rate_limit || wpforms_ai_chat_element.errors.rate_limit,
						this.modeStrings.reasons.rate_limit || wpforms_ai_chat_element.reasons.rate_limit
					);

					return;
				}

				// Handle the Internal Server Error.
				if ( error.cause === 500 ) {
					this.addEmptyResultsError();

					return;
				}

				this.addError(
					error || this.modeStrings.errors.default || wpforms_ai_chat_element.errors.default,
					this.modeStrings.reasons.default || wpforms_ai_chat_element.reasons.default
				);
				console.log( 'WPFormsAI error: ' + error ); // eslint-disable-line no-console
			} );
	}

	/**
	 * Before the first message.
	 *
	 * @since 1.9.1
	 */
	addFirstMessagePre() {
		if ( this.sessionId || this.messagePreAdded ) {
			return;
		}

		this.messagePreAdded = true;

		const divider = document.createElement( 'div' );

		divider.classList.add( 'wpforms-ai-chat-divider' );
		this.messageList.appendChild( divider );
	}

	/**
	 * Click on the default item in the welcome screen.
	 *
	 * @since 1.9.1
	 *
	 * @param {Event} e The event object.
	 */
	clickDefaultItem( e ) {
		const li = e.target.nodeName === 'LI' ? e.target : e.target.closest( 'li' );
		const message = li.querySelector( 'a' )?.textContent;

		if ( ! message ) {
			return;
		}

		this.input.value = message;
		this.sendMessage();
	}

	/**
	 * Click on the dislike button.
	 *
	 * @since 1.9.1
	 *
	 * @param {Event} e The event object.
	 */
	clickDislikeButton( e ) {
		const button = e.target;
		const answer = button?.closest( '.wpforms-chat-item-answer' );

		if ( ! answer ) {
			return;
		}

		button.classList.add( 'clicked' );
		button.setAttribute( 'disabled', true );

		const responseId = answer.getAttribute( 'data-response-id' );

		this.wpformsAiApi.rate( false, responseId );
	}

	/**
	 * Click on the refresh button.
	 *
	 * @since 1.9.1
	 */
	async clickRefreshButton() {
		const refreshConfirm = () => {
			// Restore the welcome screen.
			this.messageList.innerHTML = this.getWelcomeScreen();
			this.welcomeScreenSamplePrompts = this.querySelector( '.wpforms-ai-chat-welcome-screen-sample-prompts' );
			this.bindWelcomeScreenEvents();
			this.scrollMessagesTo( 'top' );

			// Clear the session ID.
			this.wpformsAiApi = null;
			this.sessionId = null;
			this.messagePreAdded = null;
			this.wrapper.removeAttribute( 'data-session-id' );

			// Clear the chat history.
			this.history.clear();

			// Fire the event after refreshing the chat.
			this.triggerEvent( 'wpformsAIChatAfterRefresh', { fieldId: this.fieldId } );
		};

		const refreshCancel = () => {
			// Fire the event when refresh is canceled.
			this.triggerEvent( 'wpformsAIChatCancelRefresh', { fieldId: this.fieldId } );
		};

		// Fire the event before refresh confirmation is opened.
		this.triggerEvent( 'wpformsAIChatBeforeRefreshConfirm', { fieldId: this.fieldId } );

		// Open a confirmation modal.
		WPFormsAIModal.confirmModal( {
			title: wpforms_ai_chat_element.confirm.refreshTitle,
			content: wpforms_ai_chat_element.confirm.refreshMessage,
			onConfirm: refreshConfirm,
			onCancel: refreshCancel,
		} );
	}

	/**
	 * Start loading.
	 *
	 * @since 1.9.1
	 */
	startLoading() {
		this.loadingState = true;
		this.sendButton.classList.add( 'wpforms-hidden' );
		this.stopButton.classList.remove( 'wpforms-hidden' );
		this.input.setAttribute( 'disabled', true );
		this.input.setAttribute( 'placeholder', this.modeStrings.waiting );
	}

	/**
	 * Stop loading.
	 *
	 * @since 1.9.1
	 */
	stopLoading() {
		this.loadingState = false;
		this.messageList.querySelector( '.wpforms-chat-item-answer-waiting' )?.remove();
		this.sendButton.classList.remove( 'wpforms-hidden' );
		this.stopButton.classList.add( 'wpforms-hidden' );
		this.input.removeAttribute( 'disabled' );
		this.input.setAttribute( 'placeholder', this.modeStrings.placeholder );
		this.input.focus();
	}

	/**
	 * Keyboard `ArrowUp` key event handler.
	 *
	 * @since 1.9.1
	 */
	arrowUp() {
		const prev = this.history.prev()?.question;

		if ( typeof prev !== 'undefined' ) {
			this.input.value = prev;
		}
	}

	/**
	 * Keyboard `ArrowDown` key event handler.
	 *
	 * @since 1.9.1
	 */
	arrowDown() {
		const next = this.history.next()?.question;

		if ( typeof next !== 'undefined' ) {
			this.input.value = next;
		}
	}

	/**
	 * Get AI API object instance.
	 *
	 * @since 1.9.1
	 *
	 * @return {Object} The AI API object.
	 */
	getAiApi() {
		if ( this.wpformsAiApi ) {
			return this.wpformsAiApi;
		}

		// Attempt to get the session ID from the element attribute OR the data attribute.
		// It is needed to restore the session ID after restoring the chat element.
		this.sessionId = this.wrapper.getAttribute( 'data-session-id' ) || null;

		// Create a new AI API object instance.
		this.wpformsAiApi = window.WPFormsAi.api( this.chatMode, this.sessionId );

		return this.wpformsAiApi;
	}

	/**
	 * Scroll message list to given edge.
	 *
	 * @since 1.9.1
	 *
	 * @param {string} edge The edge to scroll to; `top` or `bottom`.
	 */
	scrollMessagesTo( edge = 'bottom' ) {
		if ( edge === 'top' ) {
			this.messageList.scrollTop = 0;

			return;
		}

		if ( this.messageList.scrollHeight - this.messageList.scrollTop < 22 ) {
			return;
		}

		this.messageList.scrollTop = this.messageList.scrollHeight;
	}

	/**
	 * Add a message to the chat.
	 *
	 * @since 1.9.1
	 *
	 * @param {string}  message    The message to add.
	 * @param {boolean} isQuestion Whether it is a question.
	 * @param {Object}  response   The response data, optional.
	 *
	 * @return {HTMLElement} The message element.
	 */
	addMessage( message, isQuestion, response = null ) {
		const { messageList } = this;
		const element = document.createElement( 'div' );

		element.classList.add( 'wpforms-chat-item' );
		messageList.appendChild( element );

		if ( isQuestion ) {
			// Add a question.
			element.innerText = message;
			element.classList.add( 'wpforms-chat-item-question' );

			// Add a waiting spinner.
			const spinnerWrapper = document.createElement( 'div' ),
				spinner = document.createElement( 'div' );

			spinnerWrapper.classList.add( 'wpforms-chat-item-answer-waiting' );
			spinner.classList.add( 'wpforms-chat-item-spinner' );
			spinner.innerHTML = this.getSpinnerSvg();
			spinnerWrapper.appendChild( spinner );
			messageList.appendChild( spinnerWrapper );

			// Add an empty chat history item.
			this.history.push( {} );
		} else {
			// Add an answer.
			const itemContent = document.createElement( 'div' );

			itemContent.classList.add( 'wpforms-chat-item-content' );
			element.appendChild( itemContent );

			// Remove the waiting spinner.
			messageList.querySelector( '.wpforms-chat-item-answer-waiting' )?.remove();

			// Update element classes and attributes.
			element.classList.add( 'wpforms-chat-item-answer' );
			element.classList.add( 'wpforms-chat-item-typing' );
			element.classList.add( 'wpforms-chat-item-' + this.chatMode );
			element.setAttribute( 'data-response-id', response?.responseId ?? '' );

			// Update the answer in the chat history.
			this.history.update( { answer: message } );

			// Type the message with the typewriter effect.
			this.typeText( itemContent, message, this.addedAnswer.bind( this ) );
		}

		this.scrollMessagesTo( 'bottom' );

		return element;
	}

	/**
	 * Add an error to the chat.
	 *
	 * @since 1.9.1
	 *
	 * @param {string} errorTitle  The error title.
	 * @param {string} errorReason The error title.
	 */
	addError( errorTitle, errorReason ) {
		let content = ``;

		// Bail if loading was stopped.
		if ( ! this.loadingState ) {
			return;
		}

		if ( errorTitle ) {
			content += `<h4>${ errorTitle }</h4>`;
		}

		if ( errorReason ) {
			content += `<span>${ errorReason }</span>`;
		}

		const chatItem = document.createElement( 'div' );
		const itemContent = document.createElement( 'div' );

		chatItem.classList.add( 'wpforms-chat-item' );
		chatItem.classList.add( 'wpforms-chat-item-error' );
		itemContent.classList.add( 'wpforms-chat-item-content' );
		chatItem.appendChild( itemContent );

		this.messageList.querySelector( '.wpforms-chat-item-answer-waiting' )?.remove();
		this.messageList.appendChild( chatItem );

		// Add the error to the chat.
		// Type the message with the typewriter effect.
		this.typeText( itemContent, content, () => {
			this.stopLoading();
		} );
	}

	/**
	 * Add an empty results error to the chat.
	 */
	addEmptyResultsError() {
		this.addError(
			this.modeStrings.errors.empty || wpforms_ai_chat_element.errors.empty,
			this.modeStrings.reasons.empty || wpforms_ai_chat_element.reasons.empty
		);
	}

	/**
	 * Add an answer to the chat.
	 *
	 * @since 1.9.1
	 *
	 * @param {Object} response The response data to add.
	 */
	addAnswer( response ) {
		// Bail if loading was stopped.
		if ( ! this.loadingState || ! response ) {
			return;
		}

		const answerHTML = this.modeHelpers.getAnswer( response );

		if ( ! answerHTML ) {
			this.addEmptyResultsError();

			return;
		}

		// Store the session ID from response.
		this.sessionId = response.sessionId;

		// Set the session ID to the chat wrapper data attribute.
		this.wrapper.setAttribute( 'data-session-id', this.sessionId );

		// Add the answer to the chat.
		this.addMessage( answerHTML, false, response );
	}

	/**
	 * The added answer callback.
	 *
	 * @since 1.9.1
	 *
	 * @param {HTMLElement} element The answer element.
	 */
	addedAnswer( element ) {
		// Add answer buttons when typing is finished.
		element.innerHTML += this.getAnswerButtons();
		element.parentElement.classList.remove( 'wpforms-chat-item-typing' );

		wpf.initTooltips();

		this.stopLoading();

		// Add event listeners to the answer buttons.
		element.querySelector( '.wpforms-ai-chat-answer-button.dislike' )
			?.addEventListener( 'click', this.clickDislikeButton.bind( this ) );

		element.querySelector( '.wpforms-ai-chat-answer-button.refresh' )
			?.addEventListener( 'click', this.clickRefreshButton.bind( this ) );

		// Added answer callback.
		this.modeHelpers.addedAnswer( element );
	}

	/**
	 * Get the answer buttons HTML markup.
	 *
	 * @since 1.9.1
	 *
	 * @return {string} The answer buttons HTML markup.
	 */
	getAnswerButtons() {
		return `
			<div class="wpforms-ai-chat-answer-buttons">
				${ this.modeHelpers.getAnswerButtonsPre() }
				<div class="wpforms-ai-chat-answer-buttons-response">
					<button type="button" class="wpforms-ai-chat-answer-button dislike wpforms-help-tooltip" data-tooltip-position="top" title="${ wpforms_ai_chat_element.dislike }"></button>
					<button type="button" class="wpforms-ai-chat-answer-button refresh wpforms-help-tooltip" data-tooltip-position="top" title="${ wpforms_ai_chat_element.refresh }">
						<i class="fa fa-trash-o"></i>
					</button>
				</div>
			</div>
		`;
	}

	/**
	 * Type text into an element with the typewriter effect.
	 *
	 * @since 1.9.1
	 *
	 * @param {HTMLElement} element          The element to type into.
	 * @param {string}      text             The text to type.
	 * @param {Function}    finishedCallback The callback function to call when typing is finished.
	 */
	typeText( element, text, finishedCallback ) {
		const chunkSize = 5;
		const chat = this;
		let index = 0;
		let content = '';

		/**
		 * Type single character.
		 *
		 * @since 1.9.1
		 */
		function type() {
			const chunk = text.substring( index, index + chunkSize );

			content += chunk;
			// Remove broken HTML tag from the end of the string.
			element.innerHTML = content.replace( /<[^>]*$/g, '' );
			index += chunkSize;

			if ( index < text.length && chat.loadingState ) {
				// Recursive call to output the next chunk.
				setTimeout( type, 20 );
			} else if ( typeof finishedCallback === 'function' ) {
				// Call the callback function when typing is finished.
				finishedCallback( element );
			}

			chat.scrollMessagesTo( 'bottom' );
		}

		type();
	}

	/**
	 * Get the `helpers` object according to the chat mode.
	 *
	 * @since 1.9.1
	 *
	 * @param {WPFormsAIChatHTMLElement} chat Chat element.
	 *
	 * @return {Object} Choices helpers object.
	 */
	getHelpers( chat ) {
		const helpers = window.WPFormsAi.helpers;

		return helpers[ chat.chatMode ]( chat ) ?? null;
	}

	/**
	 * Escape HTML special characters.
	 *
	 * @since 1.9.1
	 *
	 * @param {string} html HTML string.
	 *
	 * @return {string} Escaped HTML string.
	 */
	htmlSpecialChars( html ) {
		return html.replace( /[<>]/g, ( x ) => '&#0' + x.charCodeAt( 0 ) + ';' );
	}

	/**
	 * Wrapper to trigger a custom event and return the event object.
	 *
	 * @since 1.9.1
	 *
	 * @param {string} eventName Event name to trigger (custom or native).
	 * @param {Object} args      Trigger arguments.
	 *
	 * @return {Event} Event object.
	 */
	triggerEvent( eventName, args = {} ) {
		const event = new CustomEvent( eventName, { detail: args } );

		document.dispatchEvent( event );

		return event;
	}

	/**
	 * Chat history object.
	 *
	 * @since 1.9.1
	 */
	history = {
		/**
		 * Chat history data.
		 *
		 * @since 1.9.1
		 *
		 * @type {Array}
		 */
		data: [],

		/**
		 * Chat history pointer.
		 *
		 * @since 1.9.1
		 *
		 * @type {number}
		 */
		pointer: 0,

		/**
		 * Default item.
		 *
		 * @since 1.9.1
		 *
		 * @type {Object}
		 */
		defaultItem: {
			question: '',
			answer: null,
		},

		/**
		 * Get history data by pointer.
		 *
		 * @since 1.9.1
		 *
		 * @param {number|null} pointer The history pointer.
		 *
		 * @return {Object} The history item.
		 */
		get( pointer = null ) {
			if ( pointer ) {
				this.pointer = pointer;
			}

			if ( this.pointer < 1 ) {
				this.pointer = 0;
			} else if ( this.pointer >= this.data.length ) {
				this.pointer = this.data.length - 1;
			}

			return this.data[ this.pointer ] ?? {};
		},

		/**
		 * Get history data by pointer.
		 *
		 * @since 1.9.1
		 *
		 * @return {Object} The history item.
		 */
		prev() {
			this.pointer -= 1;

			return this.get();
		},

		/**
		 * Get history data by pointer.
		 *
		 * @since 1.9.1
		 *
		 * @return {Object} The history item.
		 */
		next() {
			this.pointer += 1;

			return this.get();
		},

		/**
		 * Push an item to the chat history.
		 *
		 * @since 1.9.1
		 *
		 * @param {Object} item The item to push.
		 *
		 * @return {void}
		 */
		push( item ) {
			if ( item.answer ) {
				this.data[ this.data.length - 1 ].answer = item.answer;

				return;
			}

			this.data.push( { ...this.defaultItem, ...item } );
			this.pointer = this.data.length - 1;
		},

		/**
		 * Update the last history item.
		 *
		 * @since 1.9.1
		 *
		 * @param {Object} item The updated history item.
		 *
		 * @return {void}
		 */
		update( item ) {
			const lastKey = this.data.length > 0 ? this.data.length - 1 : 0;
			const lastItem = this.data[ lastKey ] ?? this.defaultItem;

			this.pointer = lastKey;
			this.data[ lastKey ] = { ...lastItem, ...item };
		},

		/**
		 * Clear the chat history.
		 *
		 * @since 1.9.1
		 */
		clear() {
			this.data = [];
			this.pointer = 0;
		},
	};
}
