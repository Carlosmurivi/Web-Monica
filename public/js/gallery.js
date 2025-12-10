let searchInput = document.getElementById("searchInput");
let maximumDateInput = document.getElementById("maximum-date");
let minimumDateInput = document.getElementById("minimum-date");

paintImages("", "", "");





searchInput.addEventListener('input', () => {
    const searchValue = searchInput.value ? searchInput.value : "";
    const maximumDateValue = maximumDateInput.value ? maximumDateInput.value : "";
    const minimumDateValue = minimumDateInput.value ? minimumDateInput.value : "";

    if (searchInput.value.trim().length >= 3) {
        paintImages(searchValue, maximumDateValue, minimumDateValue);
    } else {
        paintImages("", "", "");
    }
});

maximumDateInput.addEventListener('input', () => {
    const searchValue = searchInput.value ? searchInput.value : "";
    const maximumDateValue = maximumDateInput.value ? maximumDateInput.value : "";
    const minimumDateValue = minimumDateInput.value ? minimumDateInput.value : "";

    paintImages(searchValue, maximumDateValue, minimumDateValue);
});

minimumDateInput.addEventListener('input', () => {
    const searchValue = searchInput.value ? searchInput.value : "";
    const maximumDateValue = maximumDateInput.value ? maximumDateInput.value : "";
    const minimumDateValue = minimumDateInput.value ? minimumDateInput.value : "";

    paintImages(searchValue, maximumDateValue, minimumDateValue);
});





// FORMULARIO IMAGEN

var $croppie2 = new Croppie($('#croppie-field-image')[0], {
    enableExif: true,
    enableResize: true,
    enableZoom: true,
    boundary: { width: 400, height: 400 },
    viewport: {
        height: 300,
        width: 300
    },
    enableOrientation: true
});

$(document).ready(function () {
    var img_name_image;
    $('#input-image').on('change', function (e) {
        var reader = new FileReader();
        img_name_image = e.target.files[0].name;
        reader.onload = function (e) {
            $croppie2.bind({
                url: e.target.result
            });
            $('#croppie-editor-image').removeClass('d-none')
        }
        reader.readAsDataURL(this.files[0]);
    });

    $('#rotate-left-image').click(function () {
        $croppie2.rotate(90);
    });

    $('#rotate-right-image').click(function () {
        $croppie2.rotate(-90);
    });

    $('#add-image').click(function () {
        if ($('#name').val() != '' && $('#date-image').val() != '' && $('#input-image').val() != '' && $('#name').val() != null && $('#date-image').val() != null && $('#input-image').val() != null) {
            $('#add-image').addClass('d-none');
            $('#spinner-image').removeClass('d-none');
            $croppie2.result({ type: 'base64', format: 'png' }).then(function (imgBase64) {
                $.ajax({
                    url: '../src/api/v1/crop_image.php',
                    method: 'POST',
                    data: { img: imgBase64, name: $('#name').val(), date: $('#date-image').val(), fname: img_name_image },
                    dataType: 'json'
                }).done(function (response) {
                    $('#name').val('');
                    $('#date-image').val('');

                    $croppie2.bind({ url: '' });
                    $('#croppie-editor-image').addClass('d-none');
                    $('#add-image').removeClass('d-none');
                    $('#spinner-image').addClass('d-none');
                    $('#error-add-image').text("");

                    const searchValue = searchInput.value ? searchInput.value : "";
                    const maximumDateValue = maximumDateInput.value ? maximumDateInput.value : "";
                    const minimumDateValue = minimumDateInput.value ? minimumDateInput.value : "";

                    paintImages(searchValue, maximumDateValue, minimumDateValue);
                }).fail(function (err) {
                    console.error(err);
                });
            });
        } else {
            $('#error-add-image').text("Por favor, complete todos los campos");
        }
    });
});




function paintImages(place, maximumDate, minimumDate) {
    fetch("../src/api/v1/get_images.php?place=" + place + "&maximum-date=" + maximumDate + "&minimum-date=" + minimumDate)
        .then(response => response.json())
        .then(data => {
            document.getElementById('masonry').innerHTML = '';

            data['data'].forEach(image => {
                const figure = document.createElement('figure');
                figure.className = 'masonry-item';

                const img = document.createElement('img');
                img.src = image.url;

                figure.appendChild(img);
                document.getElementById('masonry').appendChild(figure);
            });
        });
}