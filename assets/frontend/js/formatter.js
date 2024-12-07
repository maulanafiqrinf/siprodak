document.addEventListener('DOMContentLoaded', (event) => {
    // Price Input Formatter
    const priceInput = document.getElementById('pricePerKg');
    priceInput.addEventListener('input', function (e) {
      let value = e.target.value.replace(/[^0-9]/g, ''); // Remove non-numeric characters
      if (value) {
        value = Number(value).toLocaleString('id-ID'); // Format number as Indonesian currency
        e.target.value = `Rp ${value}`;
      } else {
        e.target.value = '';
      }
    });
  
    priceInput.addEventListener('focus', function (e) {
      let value = e.target.value.replace(/[^\d]/g, ''); // Remove non-numeric characters
      if (value) {
        e.target.value = value;
      }
    });
  
    priceInput.addEventListener('blur', function (e) {
      let value = e.target.value.replace(/[^0-9]/g, ''); // Remove non-numeric characters
      if (value) {
        value = Number(value).toLocaleString('id-ID'); // Format number as Indonesian currency
        e.target.value = `Rp ${value}`;
      } else {
        e.target.value = '';
      }
    });
  
    // Volume Input Formatter
    const volumeInput = document.getElementById('volume');
    volumeInput.addEventListener('input', function (e) {
      let value = e.target.value.replace(/[^0-9]/g, ''); // Remove non-numeric characters
      if (value) {
        value = Number(value).toLocaleString('id-ID'); // Format number with thousand separators
        e.target.value = `${value}`;
      } else {
        e.target.value = '';
      }
    });
  
    volumeInput.addEventListener('focus', function (e) {
      let value = e.target.value.replace(/[^0-9]/g, ''); // Remove non-numeric characters
      e.target.value = value; // Set the value to the raw numeric input for easy editing
    });
  
    volumeInput.addEventListener('blur', function (e) {
      let value = e.target.value.replace(/[^0-9]/g, ''); // Remove non-numeric characters
      if (value) {
        value = Number(value).toLocaleString('id-ID'); // Format number with thousand separators
        e.target.value = `${value}`;
      } else {
        e.target.value = '';
      }
    });
  });
  