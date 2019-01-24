document.querySelector('select[name=genre]').addEventListener('change', function (event) {
   location.href = '/ebook/index.php?genre=' + event.target.value;
});

document.querySelector('select[name=author]').addEventListener('change', function (event) {
   location.href = '/ebook/index.php?author=' + event.target.value;
});