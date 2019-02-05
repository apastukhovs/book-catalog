document.querySelector('select[name=genre]').addEventListener('change', function (event) {
   location.href = '/book-catalog/index.php?genre=' + event.target.value;
});

document.querySelector('select[name=author]').addEventListener('change', function (event) {
   location.href = '/book-catalog/index.php?author=' + event.target.value;
});