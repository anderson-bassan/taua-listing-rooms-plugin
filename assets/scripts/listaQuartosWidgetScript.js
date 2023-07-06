const updatePriceWidget = () => {
  const displayTotalPriceValue = getCookie('displayTotalPrice');

  const displayTotalPrice = document.querySelector('#price-widget-display-price');
  const issTaxPrice = document.querySelector('#iss-tax-price');
  const totalPrice = document.querySelector('#total-price-widget-display-price');
  const creditCardPreviewPrice = document.querySelector('#credit-card-preview-price');
  const priceWidget = document.querySelector('#price-widget');

  displayTotalPrice.innerText = (displayTotalPriceValue * 1).toLocaleString('pt-BR', {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    });

  issTaxPrice.innerText = (displayTotalPriceValue * 0.02).toLocaleString('pt-BR', {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    });;

  totalPrice.innerText = (displayTotalPriceValue * 1.02).toLocaleString('pt-BR', {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    });

  creditCardPreviewPrice.innerText = ((displayTotalPriceValue * 1.02) / 10).toLocaleString('pt-BR', {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    });

  priceWidget.classList.add('active');


  const totalGuests = parseInt(getCookie('adults')) + parseInt(getCookie('children'));
  const checkInValue = new Date(getCookie('checkin'));
  const checkOutValue = new Date(getCookie('checkout'));

  const guests = document.querySelector('#purchase-summary .guests');
  const checkin = document.querySelector('#purchase-summary .checkin');
  const checkout = document.querySelector('#purchase-summary .checkout');
  const purchaseSummary = document.querySelector('#purchase-summary');

  guests.innerText = totalGuests;
  checkin.innerText = checkInValue.toLocaleDateString('en-US', {
      day: '2-digit',
      month: '2-digit',
      year: 'numeric'
    });
  checkout.innerText = checkOutValue.toLocaleDateString('en-US', {
      day: '2-digit',
      month: '2-digit',
      year: 'numeric'
    });

  purchaseSummary.classList.add('active');
}







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
  const popupPriceValue = document.querySelector('#popup-price-value');

  let itemData = {}; // Declare itemData outside the loop

  priceButtons.forEach(button => {
    button.addEventListener('click', (event) => {
      const item = button.closest('.item');
      itemData = Object.fromEntries(Object.entries(item.dataset));


      // const urlParams = new URLSearchParams(window.location.search);
      const urlParams = new URLSearchParams('?hotel=6&checkin=2023-08-03&checkout=2023-08-10&adults=1&children=2&child_age_1=2&child_age_2=3');
      for (const [key, value] of urlParams.entries()) {
        itemData[key] = value;
      }

      popupPriceValue.innerText = item.getAttribute('data-price');
      popupWrapper.classList.add('active');

      event.preventDefault();
    });
  });

  popupClose.addEventListener('click', () => {
    popupWrapper.classList.remove('active');
    numberDropdown.value = 1;
  });

  numberDropdown.addEventListener('change', () => {
    const dropdownValue = numberDropdown.value;

    itemData.rooms = dropdownValue;

    const url = 'http://localhost/wp-json/lista-quartos-plugin/v1/set-room-cookies';

    sendPostRequest(url, itemData, updatePriceWidget, () => {
      console.log('error');
    });

    popupWrapper.classList.remove('active');
  });


});
