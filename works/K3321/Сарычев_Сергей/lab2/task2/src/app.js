let pages = [] // Список URL-адресов
let interval = 5000 // Интервал обновления страницы по умолчанию (5 секунд)
let currentPage = 0 // Индекс текущей страницы
let intervalId // ID текущего интервала

// Функция для загрузки страницы в iframe
function loadPage(url) {
  const iframe = document.getElementById('pageIframe')
  iframe.src = url // Устанавливаем новый URL в src iframe
}

// Функция для переключения страниц
function showNextPage() {
  if (pages.length > 0) {
    loadPage(pages[currentPage])
    currentPage = (currentPage + 1) % pages.length
  }
}

// Функция для добавления нового URL в список
function addUrlToList(url) {
  pages.push(url) // Добавляем URL в массив
  updateUrlList()
}

// Функция для удаления URL из списка
function removeUrlFromList(url) {
  pages = pages.filter((page) => page !== url)
  updateUrlList()
}

// Функция для обновления списка URL в интерфейсе
function updateUrlList() {
  const urlList = document.getElementById('urlList')
  urlList.innerHTML = '' // Очищаем текущий список

  pages.forEach((url) => {
    const listItem = document.createElement('li')
    listItem.textContent = url

    // Кнопка для удаления URL
    const deleteButton = document.createElement('button')
    deleteButton.textContent = 'Удалить'
    deleteButton.onclick = function () {
      removeUrlFromList(url)
    }

    listItem.appendChild(deleteButton)
    urlList.appendChild(listItem)
  })
}

// Функция для изменения интервала
function setNewInterval(newInterval) {
  clearInterval(intervalId) // Останавливаем текущий интервал
  interval = newInterval // Устанавливаем новый интервал
  intervalId = setInterval(showNextPage, interval) // Запускаем новый интервал
}

// Обработчик формы для добавления URL
document.getElementById('urlForm').addEventListener('submit', function (event) {
  event.preventDefault()
  const urlInput = document.getElementById('urlInput')
  const url = urlInput.value.trim()

  if (url && !pages.includes(url)) {
    addUrlToList(url)
  } else {
    alert('Пожалуйста, введите новый URL или убедитесь, что он не дублируется.')
  }

  urlInput.value = '' // Очищаем поле ввода
})

// Обработчик формы для изменения интервала
document
  .getElementById('intervalForm')
  .addEventListener('submit', function (event) {
    event.preventDefault()
    const intervalInput = document.getElementById('intervalInput')
    const newInterval = parseInt(intervalInput.value.trim(), 10)

    if (newInterval >= 1000) {
      setNewInterval(newInterval)
    } else {
      alert('Интервал должен быть не менее 1000 миллисекунд (1 секунда).')
    }

    intervalInput.value = '' // Очищаем поле ввода
  })

// Функция для установки отступа для контента, чтобы не перекрывалось меню
function setContentMargin() {
  const header = document.querySelector('header')
  const content = document.querySelector('main')
  const headerHeight = header.offsetHeight // Получаем высоту меню
  content.style.marginTop = `${headerHeight}px` // Устанавливаем отступ для основного контента
}

// Запуск переключения страниц с начальным интервалом
intervalId = setInterval(showNextPage, interval)

// Если URL-адреса добавлены, начинаем с первой страницы
if (pages.length > 0) {
  loadPage(pages[0])
}

// Устанавливаем отступ для контента при загрузке страницы
window.onload = setContentMargin
