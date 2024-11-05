(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);throw new Error("Cannot find module '"+o+"'")}var f=n[o]={exports:{}};t[o][0].call(f.exports,function(e){var n=t[o][1][e];return s(n?n:e)},f,f.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
/* global wpforms_edit_post_education */

/**
 * WPForms Edit Post Education function.
 *
 * @since 1.8.1
 */

'use strict';

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
function _iterableToArrayLimit(r, l) { var t = null == r ? null : "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t.return && (u = t.return(), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }
function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }
var WPFormsEditPostEducation = window.WPFormsEditPostEducation || function (document, window, $) {
  /**
   * Public functions and properties.
   *
   * @since 1.8.1
   *
   * @type {object}
   */
  var app = {
    /**
     * Determine if the notice was showed before.
     *
     * @since 1.8.1
     */
    isNoticeVisible: false,
    /**
     * Start the engine.
     *
     * @since 1.8.1
     */
    init: function init() {
      $(window).on('load', function () {
        // In the case of jQuery 3.+, we need to wait for a ready event first.
        if (typeof $.ready.then === 'function') {
          $.ready.then(app.load);
        } else {
          app.load();
        }
      });
    },
    /**
     * Page load.
     *
     * @since 1.8.1
     */
    load: function load() {
      if (!app.isGutenbergEditor()) {
        app.maybeShowClassicNotice();
        app.bindClassicEvents();
        return;
      }
      var blockLoadedInterval = setInterval(function () {
        if (!document.querySelector('.editor-post-title__input, iframe[name="editor-canvas"]')) {
          return;
        }
        clearInterval(blockLoadedInterval);
        if (!app.isFse()) {
          app.maybeShowGutenbergNotice();
          app.bindGutenbergEvents();
          return;
        }
        var iframe = document.querySelector('iframe[name="editor-canvas"]');
        var observer = new MutationObserver(function () {
          var iframeDocument = iframe.contentDocument || iframe.contentWindow.document || {};
          if (iframeDocument.readyState === 'complete' && iframeDocument.querySelector('.editor-post-title__input')) {
            app.maybeShowGutenbergNotice();
            app.bindFseEvents();
            observer.disconnect();
          }
        });
        observer.observe(document.body, {
          subtree: true,
          childList: true
        });
      }, 200);
    },
    /**
     * Bind events for Classic Editor.
     *
     * @since 1.8.1
     */
    bindClassicEvents: function bindClassicEvents() {
      var $document = $(document);
      if (!app.isNoticeVisible) {
        $document.on('input', '#title', _.debounce(app.maybeShowClassicNotice, 1000));
      }
      $document.on('click', '.wpforms-edit-post-education-notice-close', app.closeNotice);
    },
    /**
     * Bind events for Gutenberg Editor.
     *
     * @since 1.8.1
     */
    bindGutenbergEvents: function bindGutenbergEvents() {
      var $document = $(document);
      $document.on('DOMSubtreeModified', '.edit-post-layout', app.distractionFreeModeToggle);
      if (app.isNoticeVisible) {
        return;
      }
      $document.on('input', '.editor-post-title__input', _.debounce(app.maybeShowGutenbergNotice, 1000)).on('DOMSubtreeModified', '.editor-post-title__input', _.debounce(app.maybeShowGutenbergNotice, 1000));
    },
    /**
     * Bind events for Gutenberg Editor in FSE mode.
     *
     * @since 1.8.1
     */
    bindFseEvents: function bindFseEvents() {
      var $iframe = $('iframe[name="editor-canvas"]');
      $(document).on('DOMSubtreeModified', '.edit-post-layout', app.distractionFreeModeToggle);
      $iframe.contents().on('DOMSubtreeModified', '.editor-post-title__input', _.debounce(app.maybeShowGutenbergNotice, 1000));
    },
    /**
     * Determine if the editor is Gutenberg.
     *
     * @since 1.8.1
     *
     * @returns {boolean} True if the editor is Gutenberg.
     */
    isGutenbergEditor: function isGutenbergEditor() {
      return typeof wp !== 'undefined' && typeof wp.blocks !== 'undefined';
    },
    /**
     * Determine if the editor is Gutenberg in FSE mode.
     *
     * @since 1.8.1
     *
     * @returns {boolean} True if the Gutenberg editor in FSE mode.
     */
    isFse: function isFse() {
      return Boolean($('iframe[name="editor-canvas"]').length);
    },
    /**
     * Create a notice for Gutenberg.
     *
     * @since 1.8.1
     */
    showGutenbergNotice: function showGutenbergNotice() {
      wp.data.dispatch('core/notices').createInfoNotice(wpforms_edit_post_education.gutenberg_notice.template, app.getGutenbergNoticeSettings());

      // The notice component doesn't have a way to add HTML id or class to the notice.
      // Also, the notice became visible with a delay on old Gutenberg versions.
      var hasNotice = setInterval(function () {
        var noticeBody = $('.wpforms-edit-post-education-notice-body');
        if (!noticeBody.length) {
          return;
        }
        var $notice = noticeBody.closest('.components-notice');
        $notice.addClass('wpforms-edit-post-education-notice');
        $notice.find('.is-secondary, .is-link').removeClass('is-secondary').removeClass('is-link').addClass('is-primary');

        // We can't use onDismiss callback as it was introduced in WordPress 6.0 only.
        var dismissButton = $notice.find('.components-notice__dismiss');
        if (dismissButton) {
          dismissButton.on('click', function () {
            app.updateUserMeta();
          });
        }
        clearInterval(hasNotice);
      }, 100);
    },
    /**
     * Get settings for the Gutenberg notice.
     *
     * @since 1.8.1
     *
     * @returns {object} Notice settings.
     */
    getGutenbergNoticeSettings: function getGutenbergNoticeSettings() {
      var pluginName = 'wpforms-edit-post-product-education-guide';
      var noticeSettings = {
        id: pluginName,
        isDismissible: true,
        HTML: true,
        __unstableHTML: true,
        actions: [{
          className: 'wpforms-edit-post-education-notice-guide-button',
          variant: 'primary',
          label: wpforms_edit_post_education.gutenberg_notice.button
        }]
      };
      if (!wpforms_edit_post_education.gutenberg_guide) {
        noticeSettings.actions[0].url = wpforms_edit_post_education.gutenberg_notice.url;
        return noticeSettings;
      }
      var Guide = wp.components.Guide;
      var useState = wp.element.useState;
      var registerPlugin = wp.plugins.registerPlugin;
      var unregisterPlugin = wp.plugins.unregisterPlugin;
      var GutenbergTutorial = function GutenbergTutorial() {
        var _useState = useState(true),
          _useState2 = _slicedToArray(_useState, 2),
          isOpen = _useState2[0],
          setIsOpen = _useState2[1];
        if (!isOpen) {
          return null;
        }
        return (
          /*#__PURE__*/
          // eslint-disable-next-line react/react-in-jsx-scope
          React.createElement(Guide, {
            className: "edit-post-welcome-guide",
            onFinish: function onFinish() {
              unregisterPlugin(pluginName);
              setIsOpen(false);
            },
            pages: app.getGuidePages()
          })
        );
      };
      noticeSettings.actions[0].onClick = function () {
        return registerPlugin(pluginName, {
          render: GutenbergTutorial
        });
      };
      return noticeSettings;
    },
    /**
     * Get Guide pages in proper format.
     *
     * @since 1.8.1
     *
     * @returns {Array} Guide Pages.
     */
    getGuidePages: function getGuidePages() {
      var pages = [];
      wpforms_edit_post_education.gutenberg_guide.forEach(function (page) {
        pages.push({
          /* eslint-disable react/react-in-jsx-scope */
          content: /*#__PURE__*/React.createElement(React.Fragment, null, /*#__PURE__*/React.createElement("h1", {
            className: "edit-post-welcome-guide__heading"
          }, page.title), /*#__PURE__*/React.createElement("p", {
            className: "edit-post-welcome-guide__text"
          }, page.content)),
          image: /*#__PURE__*/React.createElement("img", {
            className: "edit-post-welcome-guide__image",
            src: page.image,
            alt: page.title
          })
          /* eslint-enable react/react-in-jsx-scope */
        });
      });
      return pages;
    },
    /**
     * Show notice if the page title matches some keywords for Classic Editor.
     *
     * @since 1.8.1
     */
    maybeShowClassicNotice: function maybeShowClassicNotice() {
      if (app.isNoticeVisible) {
        return;
      }
      if (app.isTitleMatchKeywords($('#title').val())) {
        app.isNoticeVisible = true;
        $('.wpforms-edit-post-education-notice').removeClass('wpforms-hidden');
      }
    },
    /**
     * Show notice if the page title matches some keywords for Gutenberg Editor.
     *
     * @since 1.8.1
     */
    maybeShowGutenbergNotice: function maybeShowGutenbergNotice() {
      if (app.isNoticeVisible) {
        return;
      }
      var $postTitle = app.isFse() ? $('iframe[name="editor-canvas"]').contents().find('.editor-post-title__input') : $('.editor-post-title__input');
      var tagName = $postTitle.prop('tagName');
      var title = tagName === 'TEXTAREA' ? $postTitle.val() : $postTitle.text();
      if (app.isTitleMatchKeywords(title)) {
        app.isNoticeVisible = true;
        app.showGutenbergNotice();
      }
    },
    /**
     * Add notice class when the distraction mode is enabled.
     *
     * @since 1.8.1.2
     */
    distractionFreeModeToggle: function distractionFreeModeToggle() {
      if (!app.isNoticeVisible) {
        return;
      }
      var $document = $(document);
      var isDistractionFreeMode = Boolean($document.find('.is-distraction-free').length);
      if (!isDistractionFreeMode) {
        return;
      }
      var isNoticeHasClass = Boolean($('.wpforms-edit-post-education-notice').length);
      if (isNoticeHasClass) {
        return;
      }
      var $noticeBody = $document.find('.wpforms-edit-post-education-notice-body');
      var $notice = $noticeBody.closest('.components-notice');
      $notice.addClass('wpforms-edit-post-education-notice');
    },
    /**
     * Determine if the title matches keywords.
     *
     * @since 1.8.1
     *
     * @param {string} titleValue Page title value.
     *
     * @returns {boolean} True if the title matches some keywords.
     */
    isTitleMatchKeywords: function isTitleMatchKeywords(titleValue) {
      var expectedTitleRegex = new RegExp(/\b(contact|form)\b/i);
      return expectedTitleRegex.test(titleValue);
    },
    /**
     * Close a notice.
     *
     * @since 1.8.1
     */
    closeNotice: function closeNotice() {
      $(this).closest('.wpforms-edit-post-education-notice').remove();
      app.updateUserMeta();
    },
    /**
     * Update user meta and don't show the notice next time.
     *
     * @since 1.8.1
     */
    updateUserMeta: function updateUserMeta() {
      $.post(wpforms_edit_post_education.ajax_url, {
        action: 'wpforms_education_dismiss',
        nonce: wpforms_edit_post_education.education_nonce,
        section: 'edit-post-notice'
      });
    }
  };
  return app;
}(document, window, jQuery);
WPFormsEditPostEducation.init();
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6WyJfc2xpY2VkVG9BcnJheSIsImFyciIsImkiLCJfYXJyYXlXaXRoSG9sZXMiLCJfaXRlcmFibGVUb0FycmF5TGltaXQiLCJfdW5zdXBwb3J0ZWRJdGVyYWJsZVRvQXJyYXkiLCJfbm9uSXRlcmFibGVSZXN0IiwiVHlwZUVycm9yIiwibyIsIm1pbkxlbiIsIl9hcnJheUxpa2VUb0FycmF5IiwibiIsIk9iamVjdCIsInByb3RvdHlwZSIsInRvU3RyaW5nIiwiY2FsbCIsInNsaWNlIiwiY29uc3RydWN0b3IiLCJuYW1lIiwiQXJyYXkiLCJmcm9tIiwidGVzdCIsImxlbiIsImxlbmd0aCIsImFycjIiLCJyIiwibCIsInQiLCJTeW1ib2wiLCJpdGVyYXRvciIsImUiLCJ1IiwiYSIsImYiLCJuZXh0IiwiZG9uZSIsInB1c2giLCJ2YWx1ZSIsInJldHVybiIsImlzQXJyYXkiLCJXUEZvcm1zRWRpdFBvc3RFZHVjYXRpb24iLCJ3aW5kb3ciLCJkb2N1bWVudCIsIiQiLCJhcHAiLCJpc05vdGljZVZpc2libGUiLCJpbml0Iiwib24iLCJyZWFkeSIsInRoZW4iLCJsb2FkIiwiaXNHdXRlbmJlcmdFZGl0b3IiLCJtYXliZVNob3dDbGFzc2ljTm90aWNlIiwiYmluZENsYXNzaWNFdmVudHMiLCJibG9ja0xvYWRlZEludGVydmFsIiwic2V0SW50ZXJ2YWwiLCJxdWVyeVNlbGVjdG9yIiwiY2xlYXJJbnRlcnZhbCIsImlzRnNlIiwibWF5YmVTaG93R3V0ZW5iZXJnTm90aWNlIiwiYmluZEd1dGVuYmVyZ0V2ZW50cyIsImlmcmFtZSIsIm9ic2VydmVyIiwiTXV0YXRpb25PYnNlcnZlciIsImlmcmFtZURvY3VtZW50IiwiY29udGVudERvY3VtZW50IiwiY29udGVudFdpbmRvdyIsInJlYWR5U3RhdGUiLCJiaW5kRnNlRXZlbnRzIiwiZGlzY29ubmVjdCIsIm9ic2VydmUiLCJib2R5Iiwic3VidHJlZSIsImNoaWxkTGlzdCIsIiRkb2N1bWVudCIsIl8iLCJkZWJvdW5jZSIsImNsb3NlTm90aWNlIiwiZGlzdHJhY3Rpb25GcmVlTW9kZVRvZ2dsZSIsIiRpZnJhbWUiLCJjb250ZW50cyIsIndwIiwiYmxvY2tzIiwiQm9vbGVhbiIsInNob3dHdXRlbmJlcmdOb3RpY2UiLCJkYXRhIiwiZGlzcGF0Y2giLCJjcmVhdGVJbmZvTm90aWNlIiwid3Bmb3Jtc19lZGl0X3Bvc3RfZWR1Y2F0aW9uIiwiZ3V0ZW5iZXJnX25vdGljZSIsInRlbXBsYXRlIiwiZ2V0R3V0ZW5iZXJnTm90aWNlU2V0dGluZ3MiLCJoYXNOb3RpY2UiLCJub3RpY2VCb2R5IiwiJG5vdGljZSIsImNsb3Nlc3QiLCJhZGRDbGFzcyIsImZpbmQiLCJyZW1vdmVDbGFzcyIsImRpc21pc3NCdXR0b24iLCJ1cGRhdGVVc2VyTWV0YSIsInBsdWdpbk5hbWUiLCJub3RpY2VTZXR0aW5ncyIsImlkIiwiaXNEaXNtaXNzaWJsZSIsIkhUTUwiLCJfX3Vuc3RhYmxlSFRNTCIsImFjdGlvbnMiLCJjbGFzc05hbWUiLCJ2YXJpYW50IiwibGFiZWwiLCJidXR0b24iLCJndXRlbmJlcmdfZ3VpZGUiLCJ1cmwiLCJHdWlkZSIsImNvbXBvbmVudHMiLCJ1c2VTdGF0ZSIsImVsZW1lbnQiLCJyZWdpc3RlclBsdWdpbiIsInBsdWdpbnMiLCJ1bnJlZ2lzdGVyUGx1Z2luIiwiR3V0ZW5iZXJnVHV0b3JpYWwiLCJfdXNlU3RhdGUiLCJfdXNlU3RhdGUyIiwiaXNPcGVuIiwic2V0SXNPcGVuIiwiUmVhY3QiLCJjcmVhdGVFbGVtZW50Iiwib25GaW5pc2giLCJwYWdlcyIsImdldEd1aWRlUGFnZXMiLCJvbkNsaWNrIiwicmVuZGVyIiwiZm9yRWFjaCIsInBhZ2UiLCJjb250ZW50IiwiRnJhZ21lbnQiLCJ0aXRsZSIsImltYWdlIiwic3JjIiwiYWx0IiwiaXNUaXRsZU1hdGNoS2V5d29yZHMiLCJ2YWwiLCIkcG9zdFRpdGxlIiwidGFnTmFtZSIsInByb3AiLCJ0ZXh0IiwiaXNEaXN0cmFjdGlvbkZyZWVNb2RlIiwiaXNOb3RpY2VIYXNDbGFzcyIsIiRub3RpY2VCb2R5IiwidGl0bGVWYWx1ZSIsImV4cGVjdGVkVGl0bGVSZWdleCIsIlJlZ0V4cCIsInJlbW92ZSIsInBvc3QiLCJhamF4X3VybCIsImFjdGlvbiIsIm5vbmNlIiwiZWR1Y2F0aW9uX25vbmNlIiwic2VjdGlvbiIsImpRdWVyeSJdLCJzb3VyY2VzIjpbImZha2VfYTk3MTAxODcuanMiXSwic291cmNlc0NvbnRlbnQiOlsiLyogZ2xvYmFsIHdwZm9ybXNfZWRpdF9wb3N0X2VkdWNhdGlvbiAqL1xuXG4vKipcbiAqIFdQRm9ybXMgRWRpdCBQb3N0IEVkdWNhdGlvbiBmdW5jdGlvbi5cbiAqXG4gKiBAc2luY2UgMS44LjFcbiAqL1xuXG4ndXNlIHN0cmljdCc7XG5cbmNvbnN0IFdQRm9ybXNFZGl0UG9zdEVkdWNhdGlvbiA9IHdpbmRvdy5XUEZvcm1zRWRpdFBvc3RFZHVjYXRpb24gfHwgKCBmdW5jdGlvbiggZG9jdW1lbnQsIHdpbmRvdywgJCApIHtcblxuXHQvKipcblx0ICogUHVibGljIGZ1bmN0aW9ucyBhbmQgcHJvcGVydGllcy5cblx0ICpcblx0ICogQHNpbmNlIDEuOC4xXG5cdCAqXG5cdCAqIEB0eXBlIHtvYmplY3R9XG5cdCAqL1xuXHRjb25zdCBhcHAgPSB7XG5cblx0XHQvKipcblx0XHQgKiBEZXRlcm1pbmUgaWYgdGhlIG5vdGljZSB3YXMgc2hvd2VkIGJlZm9yZS5cblx0XHQgKlxuXHRcdCAqIEBzaW5jZSAxLjguMVxuXHRcdCAqL1xuXHRcdGlzTm90aWNlVmlzaWJsZTogZmFsc2UsXG5cblx0XHQvKipcblx0XHQgKiBTdGFydCB0aGUgZW5naW5lLlxuXHRcdCAqXG5cdFx0ICogQHNpbmNlIDEuOC4xXG5cdFx0ICovXG5cdFx0aW5pdDogZnVuY3Rpb24oKSB7XG5cblx0XHRcdCQoIHdpbmRvdyApLm9uKCAnbG9hZCcsIGZ1bmN0aW9uKCkge1xuXG5cdFx0XHRcdC8vIEluIHRoZSBjYXNlIG9mIGpRdWVyeSAzLissIHdlIG5lZWQgdG8gd2FpdCBmb3IgYSByZWFkeSBldmVudCBmaXJzdC5cblx0XHRcdFx0aWYgKCB0eXBlb2YgJC5yZWFkeS50aGVuID09PSAnZnVuY3Rpb24nICkge1xuXHRcdFx0XHRcdCQucmVhZHkudGhlbiggYXBwLmxvYWQgKTtcblx0XHRcdFx0fSBlbHNlIHtcblx0XHRcdFx0XHRhcHAubG9hZCgpO1xuXHRcdFx0XHR9XG5cdFx0XHR9ICk7XG5cdFx0fSxcblxuXHRcdC8qKlxuXHRcdCAqIFBhZ2UgbG9hZC5cblx0XHQgKlxuXHRcdCAqIEBzaW5jZSAxLjguMVxuXHRcdCAqL1xuXHRcdGxvYWQ6IGZ1bmN0aW9uKCkge1xuXG5cdFx0XHRpZiAoICEgYXBwLmlzR3V0ZW5iZXJnRWRpdG9yKCkgKSB7XG5cdFx0XHRcdGFwcC5tYXliZVNob3dDbGFzc2ljTm90aWNlKCk7XG5cdFx0XHRcdGFwcC5iaW5kQ2xhc3NpY0V2ZW50cygpO1xuXG5cdFx0XHRcdHJldHVybjtcblx0XHRcdH1cblxuXHRcdFx0Y29uc3QgYmxvY2tMb2FkZWRJbnRlcnZhbCA9IHNldEludGVydmFsKCBmdW5jdGlvbigpIHtcblxuXHRcdFx0XHRpZiAoICEgZG9jdW1lbnQucXVlcnlTZWxlY3RvciggJy5lZGl0b3ItcG9zdC10aXRsZV9faW5wdXQsIGlmcmFtZVtuYW1lPVwiZWRpdG9yLWNhbnZhc1wiXScgKSApIHtcblx0XHRcdFx0XHRyZXR1cm47XG5cdFx0XHRcdH1cblxuXHRcdFx0XHRjbGVhckludGVydmFsKCBibG9ja0xvYWRlZEludGVydmFsICk7XG5cblx0XHRcdFx0aWYgKCAhIGFwcC5pc0ZzZSgpICkge1xuXG5cdFx0XHRcdFx0YXBwLm1heWJlU2hvd0d1dGVuYmVyZ05vdGljZSgpO1xuXHRcdFx0XHRcdGFwcC5iaW5kR3V0ZW5iZXJnRXZlbnRzKCk7XG5cblx0XHRcdFx0XHRyZXR1cm47XG5cdFx0XHRcdH1cblxuXHRcdFx0XHRjb25zdCBpZnJhbWUgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCAnaWZyYW1lW25hbWU9XCJlZGl0b3ItY2FudmFzXCJdJyApO1xuXHRcdFx0XHRjb25zdCBvYnNlcnZlciA9IG5ldyBNdXRhdGlvbk9ic2VydmVyKCBmdW5jdGlvbigpIHtcblxuXHRcdFx0XHRcdGNvbnN0IGlmcmFtZURvY3VtZW50ID0gaWZyYW1lLmNvbnRlbnREb2N1bWVudCB8fCBpZnJhbWUuY29udGVudFdpbmRvdy5kb2N1bWVudCB8fCB7fTtcblxuXHRcdFx0XHRcdGlmICggaWZyYW1lRG9jdW1lbnQucmVhZHlTdGF0ZSA9PT0gJ2NvbXBsZXRlJyAmJiBpZnJhbWVEb2N1bWVudC5xdWVyeVNlbGVjdG9yKCAnLmVkaXRvci1wb3N0LXRpdGxlX19pbnB1dCcgKSApIHtcblx0XHRcdFx0XHRcdGFwcC5tYXliZVNob3dHdXRlbmJlcmdOb3RpY2UoKTtcblx0XHRcdFx0XHRcdGFwcC5iaW5kRnNlRXZlbnRzKCk7XG5cblx0XHRcdFx0XHRcdG9ic2VydmVyLmRpc2Nvbm5lY3QoKTtcblx0XHRcdFx0XHR9XG5cdFx0XHRcdH0gKTtcblx0XHRcdFx0b2JzZXJ2ZXIub2JzZXJ2ZSggZG9jdW1lbnQuYm9keSwgeyBzdWJ0cmVlOiB0cnVlLCBjaGlsZExpc3Q6IHRydWUgfSApO1xuXHRcdFx0fSwgMjAwICk7XG5cdFx0fSxcblxuXHRcdC8qKlxuXHRcdCAqIEJpbmQgZXZlbnRzIGZvciBDbGFzc2ljIEVkaXRvci5cblx0XHQgKlxuXHRcdCAqIEBzaW5jZSAxLjguMVxuXHRcdCAqL1xuXHRcdGJpbmRDbGFzc2ljRXZlbnRzOiBmdW5jdGlvbigpIHtcblxuXHRcdFx0Y29uc3QgJGRvY3VtZW50ID0gJCggZG9jdW1lbnQgKTtcblxuXHRcdFx0aWYgKCAhIGFwcC5pc05vdGljZVZpc2libGUgKSB7XG5cdFx0XHRcdCRkb2N1bWVudC5vbiggJ2lucHV0JywgJyN0aXRsZScsIF8uZGVib3VuY2UoIGFwcC5tYXliZVNob3dDbGFzc2ljTm90aWNlLCAxMDAwICkgKTtcblx0XHRcdH1cblxuXHRcdFx0JGRvY3VtZW50Lm9uKCAnY2xpY2snLCAnLndwZm9ybXMtZWRpdC1wb3N0LWVkdWNhdGlvbi1ub3RpY2UtY2xvc2UnLCBhcHAuY2xvc2VOb3RpY2UgKTtcblx0XHR9LFxuXG5cdFx0LyoqXG5cdFx0ICogQmluZCBldmVudHMgZm9yIEd1dGVuYmVyZyBFZGl0b3IuXG5cdFx0ICpcblx0XHQgKiBAc2luY2UgMS44LjFcblx0XHQgKi9cblx0XHRiaW5kR3V0ZW5iZXJnRXZlbnRzOiBmdW5jdGlvbigpIHtcblxuXHRcdFx0Y29uc3QgJGRvY3VtZW50ID0gJCggZG9jdW1lbnQgKTtcblxuXHRcdFx0JGRvY3VtZW50XG5cdFx0XHRcdC5vbiggJ0RPTVN1YnRyZWVNb2RpZmllZCcsICcuZWRpdC1wb3N0LWxheW91dCcsIGFwcC5kaXN0cmFjdGlvbkZyZWVNb2RlVG9nZ2xlICk7XG5cblx0XHRcdGlmICggYXBwLmlzTm90aWNlVmlzaWJsZSApIHtcblx0XHRcdFx0cmV0dXJuO1xuXHRcdFx0fVxuXG5cdFx0XHQkZG9jdW1lbnRcblx0XHRcdFx0Lm9uKCAnaW5wdXQnLCAnLmVkaXRvci1wb3N0LXRpdGxlX19pbnB1dCcsIF8uZGVib3VuY2UoIGFwcC5tYXliZVNob3dHdXRlbmJlcmdOb3RpY2UsIDEwMDAgKSApXG5cdFx0XHRcdC5vbiggJ0RPTVN1YnRyZWVNb2RpZmllZCcsICcuZWRpdG9yLXBvc3QtdGl0bGVfX2lucHV0JywgXy5kZWJvdW5jZSggYXBwLm1heWJlU2hvd0d1dGVuYmVyZ05vdGljZSwgMTAwMCApICk7XG5cdFx0fSxcblxuXHRcdC8qKlxuXHRcdCAqIEJpbmQgZXZlbnRzIGZvciBHdXRlbmJlcmcgRWRpdG9yIGluIEZTRSBtb2RlLlxuXHRcdCAqXG5cdFx0ICogQHNpbmNlIDEuOC4xXG5cdFx0ICovXG5cdFx0YmluZEZzZUV2ZW50czogZnVuY3Rpb24oKSB7XG5cblx0XHRcdGNvbnN0ICRpZnJhbWUgPSAkKCAnaWZyYW1lW25hbWU9XCJlZGl0b3ItY2FudmFzXCJdJyApO1xuXG5cdFx0XHQkKCBkb2N1bWVudCApXG5cdFx0XHRcdC5vbiggJ0RPTVN1YnRyZWVNb2RpZmllZCcsICcuZWRpdC1wb3N0LWxheW91dCcsIGFwcC5kaXN0cmFjdGlvbkZyZWVNb2RlVG9nZ2xlICk7XG5cblx0XHRcdCRpZnJhbWUuY29udGVudHMoKVxuXHRcdFx0XHQub24oICdET01TdWJ0cmVlTW9kaWZpZWQnLCAnLmVkaXRvci1wb3N0LXRpdGxlX19pbnB1dCcsIF8uZGVib3VuY2UoIGFwcC5tYXliZVNob3dHdXRlbmJlcmdOb3RpY2UsIDEwMDAgKSApO1xuXHRcdH0sXG5cblx0XHQvKipcblx0XHQgKiBEZXRlcm1pbmUgaWYgdGhlIGVkaXRvciBpcyBHdXRlbmJlcmcuXG5cdFx0ICpcblx0XHQgKiBAc2luY2UgMS44LjFcblx0XHQgKlxuXHRcdCAqIEByZXR1cm5zIHtib29sZWFufSBUcnVlIGlmIHRoZSBlZGl0b3IgaXMgR3V0ZW5iZXJnLlxuXHRcdCAqL1xuXHRcdGlzR3V0ZW5iZXJnRWRpdG9yOiBmdW5jdGlvbigpIHtcblxuXHRcdFx0cmV0dXJuIHR5cGVvZiB3cCAhPT0gJ3VuZGVmaW5lZCcgJiYgdHlwZW9mIHdwLmJsb2NrcyAhPT0gJ3VuZGVmaW5lZCc7XG5cdFx0fSxcblxuXHRcdC8qKlxuXHRcdCAqIERldGVybWluZSBpZiB0aGUgZWRpdG9yIGlzIEd1dGVuYmVyZyBpbiBGU0UgbW9kZS5cblx0XHQgKlxuXHRcdCAqIEBzaW5jZSAxLjguMVxuXHRcdCAqXG5cdFx0ICogQHJldHVybnMge2Jvb2xlYW59IFRydWUgaWYgdGhlIEd1dGVuYmVyZyBlZGl0b3IgaW4gRlNFIG1vZGUuXG5cdFx0ICovXG5cdFx0aXNGc2U6IGZ1bmN0aW9uKCkge1xuXG5cdFx0XHRyZXR1cm4gQm9vbGVhbiggJCggJ2lmcmFtZVtuYW1lPVwiZWRpdG9yLWNhbnZhc1wiXScgKS5sZW5ndGggKTtcblx0XHR9LFxuXG5cdFx0LyoqXG5cdFx0ICogQ3JlYXRlIGEgbm90aWNlIGZvciBHdXRlbmJlcmcuXG5cdFx0ICpcblx0XHQgKiBAc2luY2UgMS44LjFcblx0XHQgKi9cblx0XHRzaG93R3V0ZW5iZXJnTm90aWNlKCkge1xuXHRcdFx0d3AuZGF0YS5kaXNwYXRjaCggJ2NvcmUvbm90aWNlcycgKS5jcmVhdGVJbmZvTm90aWNlKFxuXHRcdFx0XHR3cGZvcm1zX2VkaXRfcG9zdF9lZHVjYXRpb24uZ3V0ZW5iZXJnX25vdGljZS50ZW1wbGF0ZSxcblx0XHRcdFx0YXBwLmdldEd1dGVuYmVyZ05vdGljZVNldHRpbmdzKClcblx0XHRcdCk7XG5cblx0XHRcdC8vIFRoZSBub3RpY2UgY29tcG9uZW50IGRvZXNuJ3QgaGF2ZSBhIHdheSB0byBhZGQgSFRNTCBpZCBvciBjbGFzcyB0byB0aGUgbm90aWNlLlxuXHRcdFx0Ly8gQWxzbywgdGhlIG5vdGljZSBiZWNhbWUgdmlzaWJsZSB3aXRoIGEgZGVsYXkgb24gb2xkIEd1dGVuYmVyZyB2ZXJzaW9ucy5cblx0XHRcdGNvbnN0IGhhc05vdGljZSA9IHNldEludGVydmFsKCBmdW5jdGlvbigpIHtcblxuXHRcdFx0XHRjb25zdCBub3RpY2VCb2R5ID0gJCggJy53cGZvcm1zLWVkaXQtcG9zdC1lZHVjYXRpb24tbm90aWNlLWJvZHknICk7XG5cdFx0XHRcdGlmICggISBub3RpY2VCb2R5Lmxlbmd0aCApIHtcblx0XHRcdFx0XHRyZXR1cm47XG5cdFx0XHRcdH1cblxuXHRcdFx0XHRjb25zdCAkbm90aWNlID0gbm90aWNlQm9keS5jbG9zZXN0KCAnLmNvbXBvbmVudHMtbm90aWNlJyApO1xuXHRcdFx0XHQkbm90aWNlLmFkZENsYXNzKCAnd3Bmb3Jtcy1lZGl0LXBvc3QtZWR1Y2F0aW9uLW5vdGljZScgKTtcblx0XHRcdFx0JG5vdGljZS5maW5kKCAnLmlzLXNlY29uZGFyeSwgLmlzLWxpbmsnICkucmVtb3ZlQ2xhc3MoICdpcy1zZWNvbmRhcnknICkucmVtb3ZlQ2xhc3MoICdpcy1saW5rJyApLmFkZENsYXNzKCAnaXMtcHJpbWFyeScgKTtcblxuXHRcdFx0XHQvLyBXZSBjYW4ndCB1c2Ugb25EaXNtaXNzIGNhbGxiYWNrIGFzIGl0IHdhcyBpbnRyb2R1Y2VkIGluIFdvcmRQcmVzcyA2LjAgb25seS5cblx0XHRcdFx0Y29uc3QgZGlzbWlzc0J1dHRvbiA9ICRub3RpY2UuZmluZCggJy5jb21wb25lbnRzLW5vdGljZV9fZGlzbWlzcycgKTtcblx0XHRcdFx0aWYgKCBkaXNtaXNzQnV0dG9uICkge1xuXHRcdFx0XHRcdGRpc21pc3NCdXR0b24ub24oICdjbGljaycsIGZ1bmN0aW9uKCkge1xuXHRcdFx0XHRcdFx0YXBwLnVwZGF0ZVVzZXJNZXRhKCk7XG5cdFx0XHRcdFx0fSApO1xuXHRcdFx0XHR9XG5cblx0XHRcdFx0Y2xlYXJJbnRlcnZhbCggaGFzTm90aWNlICk7XG5cdFx0XHR9LCAxMDAgKTtcblx0XHR9LFxuXG5cdFx0LyoqXG5cdFx0ICogR2V0IHNldHRpbmdzIGZvciB0aGUgR3V0ZW5iZXJnIG5vdGljZS5cblx0XHQgKlxuXHRcdCAqIEBzaW5jZSAxLjguMVxuXHRcdCAqXG5cdFx0ICogQHJldHVybnMge29iamVjdH0gTm90aWNlIHNldHRpbmdzLlxuXHRcdCAqL1xuXHRcdGdldEd1dGVuYmVyZ05vdGljZVNldHRpbmdzOiBmdW5jdGlvbigpIHtcblxuXHRcdFx0Y29uc3QgcGx1Z2luTmFtZSA9ICd3cGZvcm1zLWVkaXQtcG9zdC1wcm9kdWN0LWVkdWNhdGlvbi1ndWlkZSc7XG5cdFx0XHRjb25zdCBub3RpY2VTZXR0aW5ncyA9IHtcblx0XHRcdFx0aWQ6IHBsdWdpbk5hbWUsXG5cdFx0XHRcdGlzRGlzbWlzc2libGU6IHRydWUsXG5cdFx0XHRcdEhUTUw6IHRydWUsXG5cdFx0XHRcdF9fdW5zdGFibGVIVE1MOiB0cnVlLFxuXHRcdFx0XHRhY3Rpb25zOiBbXG5cdFx0XHRcdFx0e1xuXHRcdFx0XHRcdFx0Y2xhc3NOYW1lOiAnd3Bmb3Jtcy1lZGl0LXBvc3QtZWR1Y2F0aW9uLW5vdGljZS1ndWlkZS1idXR0b24nLFxuXHRcdFx0XHRcdFx0dmFyaWFudDogJ3ByaW1hcnknLFxuXHRcdFx0XHRcdFx0bGFiZWw6IHdwZm9ybXNfZWRpdF9wb3N0X2VkdWNhdGlvbi5ndXRlbmJlcmdfbm90aWNlLmJ1dHRvbixcblx0XHRcdFx0XHR9LFxuXHRcdFx0XHRdLFxuXHRcdFx0fTtcblxuXHRcdFx0aWYgKCAhIHdwZm9ybXNfZWRpdF9wb3N0X2VkdWNhdGlvbi5ndXRlbmJlcmdfZ3VpZGUgKSB7XG5cblx0XHRcdFx0bm90aWNlU2V0dGluZ3MuYWN0aW9uc1swXS51cmwgPSB3cGZvcm1zX2VkaXRfcG9zdF9lZHVjYXRpb24uZ3V0ZW5iZXJnX25vdGljZS51cmw7XG5cblx0XHRcdFx0cmV0dXJuIG5vdGljZVNldHRpbmdzO1xuXHRcdFx0fVxuXG5cdFx0XHRjb25zdCBHdWlkZSA9IHdwLmNvbXBvbmVudHMuR3VpZGU7XG5cdFx0XHRjb25zdCB1c2VTdGF0ZSA9IHdwLmVsZW1lbnQudXNlU3RhdGU7XG5cdFx0XHRjb25zdCByZWdpc3RlclBsdWdpbiA9IHdwLnBsdWdpbnMucmVnaXN0ZXJQbHVnaW47XG5cdFx0XHRjb25zdCB1bnJlZ2lzdGVyUGx1Z2luID0gd3AucGx1Z2lucy51bnJlZ2lzdGVyUGx1Z2luO1xuXHRcdFx0Y29uc3QgR3V0ZW5iZXJnVHV0b3JpYWwgPSBmdW5jdGlvbigpIHtcblxuXHRcdFx0XHRjb25zdCBbIGlzT3Blbiwgc2V0SXNPcGVuIF0gPSB1c2VTdGF0ZSggdHJ1ZSApO1xuXG5cdFx0XHRcdGlmICggISBpc09wZW4gKSB7XG5cdFx0XHRcdFx0cmV0dXJuIG51bGw7XG5cdFx0XHRcdH1cblxuXHRcdFx0XHRyZXR1cm4gKFxuXHRcdFx0XHRcdC8vIGVzbGludC1kaXNhYmxlLW5leHQtbGluZSByZWFjdC9yZWFjdC1pbi1qc3gtc2NvcGVcblx0XHRcdFx0XHQ8R3VpZGVcblx0XHRcdFx0XHRcdGNsYXNzTmFtZT1cImVkaXQtcG9zdC13ZWxjb21lLWd1aWRlXCJcblx0XHRcdFx0XHRcdG9uRmluaXNoPXsgKCkgPT4ge1xuXHRcdFx0XHRcdFx0XHR1bnJlZ2lzdGVyUGx1Z2luKCBwbHVnaW5OYW1lICk7XG5cdFx0XHRcdFx0XHRcdHNldElzT3BlbiggZmFsc2UgKTtcblx0XHRcdFx0XHRcdH0gfVxuXHRcdFx0XHRcdFx0cGFnZXM9eyBhcHAuZ2V0R3VpZGVQYWdlcygpIH1cblx0XHRcdFx0XHQvPlxuXHRcdFx0XHQpO1xuXHRcdFx0fTtcblxuXHRcdFx0bm90aWNlU2V0dGluZ3MuYWN0aW9uc1swXS5vbkNsaWNrID0gKCkgPT4gcmVnaXN0ZXJQbHVnaW4oIHBsdWdpbk5hbWUsIHsgcmVuZGVyOiBHdXRlbmJlcmdUdXRvcmlhbCB9ICk7XG5cblx0XHRcdHJldHVybiBub3RpY2VTZXR0aW5ncztcblx0XHR9LFxuXG5cdFx0LyoqXG5cdFx0ICogR2V0IEd1aWRlIHBhZ2VzIGluIHByb3BlciBmb3JtYXQuXG5cdFx0ICpcblx0XHQgKiBAc2luY2UgMS44LjFcblx0XHQgKlxuXHRcdCAqIEByZXR1cm5zIHtBcnJheX0gR3VpZGUgUGFnZXMuXG5cdFx0ICovXG5cdFx0Z2V0R3VpZGVQYWdlczogZnVuY3Rpb24oKSB7XG5cblx0XHRcdGNvbnN0IHBhZ2VzID0gW107XG5cblx0XHRcdHdwZm9ybXNfZWRpdF9wb3N0X2VkdWNhdGlvbi5ndXRlbmJlcmdfZ3VpZGUuZm9yRWFjaCggZnVuY3Rpb24oIHBhZ2UgKSB7XG5cdFx0XHRcdHBhZ2VzLnB1c2goXG5cdFx0XHRcdFx0e1xuXHRcdFx0XHRcdFx0LyogZXNsaW50LWRpc2FibGUgcmVhY3QvcmVhY3QtaW4tanN4LXNjb3BlICovXG5cdFx0XHRcdFx0XHRjb250ZW50OiAoXG5cdFx0XHRcdFx0XHRcdDw+XG5cdFx0XHRcdFx0XHRcdFx0PGgxIGNsYXNzTmFtZT1cImVkaXQtcG9zdC13ZWxjb21lLWd1aWRlX19oZWFkaW5nXCI+eyBwYWdlLnRpdGxlIH08L2gxPlxuXHRcdFx0XHRcdFx0XHRcdDxwIGNsYXNzTmFtZT1cImVkaXQtcG9zdC13ZWxjb21lLWd1aWRlX190ZXh0XCI+eyBwYWdlLmNvbnRlbnQgfTwvcD5cblx0XHRcdFx0XHRcdFx0PC8+XG5cdFx0XHRcdFx0XHQpLFxuXHRcdFx0XHRcdFx0aW1hZ2U6IDxpbWcgY2xhc3NOYW1lPVwiZWRpdC1wb3N0LXdlbGNvbWUtZ3VpZGVfX2ltYWdlXCIgc3JjPXsgcGFnZS5pbWFnZSB9IGFsdD17IHBhZ2UudGl0bGUgfSAvPixcblx0XHRcdFx0XHRcdC8qIGVzbGludC1lbmFibGUgcmVhY3QvcmVhY3QtaW4tanN4LXNjb3BlICovXG5cdFx0XHRcdFx0fVxuXHRcdFx0XHQpO1xuXHRcdFx0fSApO1xuXG5cdFx0XHRyZXR1cm4gcGFnZXM7XG5cdFx0fSxcblxuXHRcdC8qKlxuXHRcdCAqIFNob3cgbm90aWNlIGlmIHRoZSBwYWdlIHRpdGxlIG1hdGNoZXMgc29tZSBrZXl3b3JkcyBmb3IgQ2xhc3NpYyBFZGl0b3IuXG5cdFx0ICpcblx0XHQgKiBAc2luY2UgMS44LjFcblx0XHQgKi9cblx0XHRtYXliZVNob3dDbGFzc2ljTm90aWNlOiBmdW5jdGlvbigpIHtcblxuXHRcdFx0aWYgKCBhcHAuaXNOb3RpY2VWaXNpYmxlICkge1xuXHRcdFx0XHRyZXR1cm47XG5cdFx0XHR9XG5cblx0XHRcdGlmICggYXBwLmlzVGl0bGVNYXRjaEtleXdvcmRzKCAkKCAnI3RpdGxlJyApLnZhbCgpICkgKSB7XG5cdFx0XHRcdGFwcC5pc05vdGljZVZpc2libGUgPSB0cnVlO1xuXG5cdFx0XHRcdCQoICcud3Bmb3Jtcy1lZGl0LXBvc3QtZWR1Y2F0aW9uLW5vdGljZScgKS5yZW1vdmVDbGFzcyggJ3dwZm9ybXMtaGlkZGVuJyApO1xuXHRcdFx0fVxuXHRcdH0sXG5cblx0XHQvKipcblx0XHQgKiBTaG93IG5vdGljZSBpZiB0aGUgcGFnZSB0aXRsZSBtYXRjaGVzIHNvbWUga2V5d29yZHMgZm9yIEd1dGVuYmVyZyBFZGl0b3IuXG5cdFx0ICpcblx0XHQgKiBAc2luY2UgMS44LjFcblx0XHQgKi9cblx0XHRtYXliZVNob3dHdXRlbmJlcmdOb3RpY2U6IGZ1bmN0aW9uKCkge1xuXG5cdFx0XHRpZiAoIGFwcC5pc05vdGljZVZpc2libGUgKSB7XG5cdFx0XHRcdHJldHVybjtcblx0XHRcdH1cblxuXHRcdFx0Y29uc3QgJHBvc3RUaXRsZSA9IGFwcC5pc0ZzZSgpID9cblx0XHRcdFx0JCggJ2lmcmFtZVtuYW1lPVwiZWRpdG9yLWNhbnZhc1wiXScgKS5jb250ZW50cygpLmZpbmQoICcuZWRpdG9yLXBvc3QtdGl0bGVfX2lucHV0JyApIDpcblx0XHRcdFx0JCggJy5lZGl0b3ItcG9zdC10aXRsZV9faW5wdXQnICk7XG5cdFx0XHRjb25zdCB0YWdOYW1lID0gJHBvc3RUaXRsZS5wcm9wKCAndGFnTmFtZScgKTtcblx0XHRcdGNvbnN0IHRpdGxlID0gdGFnTmFtZSA9PT0gJ1RFWFRBUkVBJyA/ICRwb3N0VGl0bGUudmFsKCkgOiAkcG9zdFRpdGxlLnRleHQoKTtcblxuXHRcdFx0aWYgKCBhcHAuaXNUaXRsZU1hdGNoS2V5d29yZHMoIHRpdGxlICkgKSB7XG5cdFx0XHRcdGFwcC5pc05vdGljZVZpc2libGUgPSB0cnVlO1xuXG5cdFx0XHRcdGFwcC5zaG93R3V0ZW5iZXJnTm90aWNlKCk7XG5cdFx0XHR9XG5cdFx0fSxcblxuXHRcdC8qKlxuXHRcdCAqIEFkZCBub3RpY2UgY2xhc3Mgd2hlbiB0aGUgZGlzdHJhY3Rpb24gbW9kZSBpcyBlbmFibGVkLlxuXHRcdCAqXG5cdFx0ICogQHNpbmNlIDEuOC4xLjJcblx0XHQgKi9cblx0XHRkaXN0cmFjdGlvbkZyZWVNb2RlVG9nZ2xlOiBmdW5jdGlvbigpIHtcblxuXHRcdFx0aWYgKCAhIGFwcC5pc05vdGljZVZpc2libGUgKSB7XG5cdFx0XHRcdHJldHVybjtcblx0XHRcdH1cblxuXHRcdFx0Y29uc3QgJGRvY3VtZW50ID0gJCggZG9jdW1lbnQgKTtcblx0XHRcdGNvbnN0IGlzRGlzdHJhY3Rpb25GcmVlTW9kZSA9IEJvb2xlYW4oICRkb2N1bWVudC5maW5kKCAnLmlzLWRpc3RyYWN0aW9uLWZyZWUnICkubGVuZ3RoICk7XG5cblx0XHRcdGlmICggISBpc0Rpc3RyYWN0aW9uRnJlZU1vZGUgKSB7XG5cdFx0XHRcdHJldHVybjtcblx0XHRcdH1cblxuXHRcdFx0Y29uc3QgaXNOb3RpY2VIYXNDbGFzcyA9IEJvb2xlYW4oICQoICcud3Bmb3Jtcy1lZGl0LXBvc3QtZWR1Y2F0aW9uLW5vdGljZScgKS5sZW5ndGggKTtcblxuXHRcdFx0aWYgKCBpc05vdGljZUhhc0NsYXNzICkge1xuXHRcdFx0XHRyZXR1cm47XG5cdFx0XHR9XG5cblx0XHRcdGNvbnN0ICRub3RpY2VCb2R5ID0gJGRvY3VtZW50LmZpbmQoICcud3Bmb3Jtcy1lZGl0LXBvc3QtZWR1Y2F0aW9uLW5vdGljZS1ib2R5JyApO1xuXHRcdFx0Y29uc3QgJG5vdGljZSA9ICRub3RpY2VCb2R5LmNsb3Nlc3QoICcuY29tcG9uZW50cy1ub3RpY2UnICk7XG5cblx0XHRcdCRub3RpY2UuYWRkQ2xhc3MoICd3cGZvcm1zLWVkaXQtcG9zdC1lZHVjYXRpb24tbm90aWNlJyApO1xuXHRcdH0sXG5cblx0XHQvKipcblx0XHQgKiBEZXRlcm1pbmUgaWYgdGhlIHRpdGxlIG1hdGNoZXMga2V5d29yZHMuXG5cdFx0ICpcblx0XHQgKiBAc2luY2UgMS44LjFcblx0XHQgKlxuXHRcdCAqIEBwYXJhbSB7c3RyaW5nfSB0aXRsZVZhbHVlIFBhZ2UgdGl0bGUgdmFsdWUuXG5cdFx0ICpcblx0XHQgKiBAcmV0dXJucyB7Ym9vbGVhbn0gVHJ1ZSBpZiB0aGUgdGl0bGUgbWF0Y2hlcyBzb21lIGtleXdvcmRzLlxuXHRcdCAqL1xuXHRcdGlzVGl0bGVNYXRjaEtleXdvcmRzOiBmdW5jdGlvbiggdGl0bGVWYWx1ZSApIHtcblxuXHRcdFx0Y29uc3QgZXhwZWN0ZWRUaXRsZVJlZ2V4ID0gbmV3IFJlZ0V4cCggL1xcYihjb250YWN0fGZvcm0pXFxiL2kgKTtcblxuXHRcdFx0cmV0dXJuIGV4cGVjdGVkVGl0bGVSZWdleC50ZXN0KCB0aXRsZVZhbHVlICk7XG5cdFx0fSxcblxuXHRcdC8qKlxuXHRcdCAqIENsb3NlIGEgbm90aWNlLlxuXHRcdCAqXG5cdFx0ICogQHNpbmNlIDEuOC4xXG5cdFx0ICovXG5cdFx0Y2xvc2VOb3RpY2U6IGZ1bmN0aW9uKCkge1xuXG5cdFx0XHQkKCB0aGlzICkuY2xvc2VzdCggJy53cGZvcm1zLWVkaXQtcG9zdC1lZHVjYXRpb24tbm90aWNlJyApLnJlbW92ZSgpO1xuXG5cdFx0XHRhcHAudXBkYXRlVXNlck1ldGEoKTtcblx0XHR9LFxuXG5cdFx0LyoqXG5cdFx0ICogVXBkYXRlIHVzZXIgbWV0YSBhbmQgZG9uJ3Qgc2hvdyB0aGUgbm90aWNlIG5leHQgdGltZS5cblx0XHQgKlxuXHRcdCAqIEBzaW5jZSAxLjguMVxuXHRcdCAqL1xuXHRcdHVwZGF0ZVVzZXJNZXRhKCkge1xuXG5cdFx0XHQkLnBvc3QoXG5cdFx0XHRcdHdwZm9ybXNfZWRpdF9wb3N0X2VkdWNhdGlvbi5hamF4X3VybCxcblx0XHRcdFx0e1xuXHRcdFx0XHRcdGFjdGlvbjogJ3dwZm9ybXNfZWR1Y2F0aW9uX2Rpc21pc3MnLFxuXHRcdFx0XHRcdG5vbmNlOiB3cGZvcm1zX2VkaXRfcG9zdF9lZHVjYXRpb24uZWR1Y2F0aW9uX25vbmNlLFxuXHRcdFx0XHRcdHNlY3Rpb246ICdlZGl0LXBvc3Qtbm90aWNlJyxcblx0XHRcdFx0fVxuXHRcdFx0KTtcblx0XHR9LFxuXHR9O1xuXG5cdHJldHVybiBhcHA7XG5cbn0oIGRvY3VtZW50LCB3aW5kb3csIGpRdWVyeSApICk7XG5cbldQRm9ybXNFZGl0UG9zdEVkdWNhdGlvbi5pbml0KCk7XG4iXSwibWFwcGluZ3MiOiJBQUFBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUEsWUFBWTs7QUFBQyxTQUFBQSxlQUFBQyxHQUFBLEVBQUFDLENBQUEsV0FBQUMsZUFBQSxDQUFBRixHQUFBLEtBQUFHLHFCQUFBLENBQUFILEdBQUEsRUFBQUMsQ0FBQSxLQUFBRywyQkFBQSxDQUFBSixHQUFBLEVBQUFDLENBQUEsS0FBQUksZ0JBQUE7QUFBQSxTQUFBQSxpQkFBQSxjQUFBQyxTQUFBO0FBQUEsU0FBQUYsNEJBQUFHLENBQUEsRUFBQUMsTUFBQSxTQUFBRCxDQUFBLHFCQUFBQSxDQUFBLHNCQUFBRSxpQkFBQSxDQUFBRixDQUFBLEVBQUFDLE1BQUEsT0FB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
},{}]},{},[1])