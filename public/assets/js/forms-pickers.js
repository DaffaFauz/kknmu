/**
 * Form Picker
 */

'use strict';

(function () {
  // Flat Picker
  // --------------------------------------------------------------------
  const flatpickrFriendly = document.querySelector('#flatpickr-human-friendly')

  // Human Friendly
  if (flatpickrFriendly) {
    flatpickrFriendly.flatpickr({
      altInput: true,
      altFormat: 'F j, Y',
      dateFormat: 'Y-m-d',
      static: true
    });
  }
})();
