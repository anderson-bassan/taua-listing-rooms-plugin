window.addEventListener('load', () => {
  const sliders = document.querySelectorAll('.slider-wrapper');

  sliders.forEach(slider => {
    const slideItems = slider.querySelectorAll('.slide');
    const dotContainer = slider.querySelector('.dots-wrapper');
    const dots = dotContainer.querySelectorAll('.dot');

    function changeActiveSlide() {
      const activeSlide = slider.querySelector('.slide.active');
      const activeDot = dotContainer.querySelector('.dot.active');
      const activeIndex = parseInt(slider.getAttribute('data-active'));

      activeSlide.classList.remove('active');
      activeDot.classList.remove('active');

      const nextIndex = (activeIndex + 1) % slideItems.length;
      const nextSlide = slideItems[nextIndex];
      const nextDot = dots[nextIndex];

      nextSlide.classList.add('active');
      nextDot.classList.add('active');

      slider.setAttribute('data-active', nextIndex.toString());
    }

    function changeSlide(index) {
      const activeSlide = slider.querySelector('.slide.active');
      const activeDot = dotContainer.querySelector('.dot.active');

      activeSlide.classList.remove('active');
      activeDot.classList.remove('active');

      const nextSlide = slideItems[index];
      const nextDot = dots[index];

      nextSlide.classList.add('active');
      nextDot.classList.add('active');

      slider.setAttribute('data-active', index.toString());
    }

    dots.forEach((dot, index) => {
      dot.addEventListener('click', () => {
        changeSlide(index);
      });
    });

    setInterval(changeActiveSlide, 2000);
  });


  const priceButtons = document.querySelectorAll('.price-button');
  const popupClose = document.querySelector('#popup-close');
  const popupWrapper = document.querySelector('.popup-wrapper');
  const sendButton = document.querySelector('#send-button');
  const numberDropdown = document.querySelector('#number-dropdown');
  const priceInput = document.querySelector('#price-input');
  const priceWidget = document.querySelector('#price-widget');

  let itemData = {}; // Declare itemData outside the loop

  priceButtons.forEach(button => {
    button.addEventListener('click', (event) => {
      const item = button.closest('.item');
      itemData = Object.fromEntries(Object.entries(item.dataset));

      popupWrapper.classList.add('active');

      event.preventDefault();
    });
  });

  popupClose.addEventListener('click', () => {
    popupWrapper.classList.remove('active');
    numberDropdown.value = 1;
  });

  sendButton.addEventListener('click', () => {
    const dropdownValue = numberDropdown.value;

    itemData.rooms = dropdownValue;

    const url = 'http://localhost/wp-json/lista-quartos-plugin/v1/get-room-price';

    fetch(url, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(itemData)
    })
    .then(response => response.json())
    .then(json => JSON.parse(json))
    .then(data => {
      priceWidget.innerText = 'R$ ' + data.total_price;
    })
    .catch(error => {
      console.error('Error sending data:', error);
    });

    popupWrapper.classList.remove('active');
  });


});
