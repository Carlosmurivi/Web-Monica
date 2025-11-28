const tripContainer = document.getElementById('tripContainer');
let id_carrusel = crypto.randomUUID();



var $croppie1 = new Croppie($('#croppie-field')[0], {
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

$(document).on('click', '.eliminar-item', function (e) {
    fetch("../src/api/v1/delete_item.php?id=" + e.target.getAttribute("id-item"))
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            $(this).closest('.item-carrusel').remove();
        });
});

$(document).ready(function () {
    // FORMULARIO PORTADA

    var img_name;
    $('#front-page').on('change', function (e) {
        var reader = new FileReader();
        img_name = e.target.files[0].name;
        reader.onload = function (e) {
            $croppie1.bind({
                url: e.target.result
            });
        }
        reader.readAsDataURL(this.files[0]);
    });





    // FORMULARIO IMAGEN

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
        if ($('#name').val() != '' && $('#date-image').val() != '' && $('#input-image').val() != '' && $('#size-image').val() != '' && $('#name').val() != null && $('#date-image').val() != null && $('#input-image').val() != null && $('#size-image').val() != null) {
            $('#add-image').addClass('d-none');
            $('#spinner-image').removeClass('d-none');
            $croppie2.result({ type: 'base64', format: 'png' }).then(function (imgBase64) {
                $.ajax({
                    url: '../src/api/v1/crop_image.php',
                    method: 'POST',
                    data: { img: imgBase64, name: $('#name').val(), date: $('#date-image').val(), fname: img_name_image, size: $('#size-image').val() },
                    dataType: 'json'
                }).done(function (response) {
                    tripContainer.appendChild(paintImage(response['id'], $('#date-image').val(), response['url'], $('#size-image').val()));
                    $('#name').val('');
                    $('#input-image').val('');
                    $('#date-image').val('');
                    $('#size-image').val('');

                    $croppie2.bind({ url: '' });
                    $('#croppie-editor-image').addClass('d-none');
                    $('#add-image').removeClass('d-none');
                    $('#spinner-image').addClass('d-none');
                    $('#error-add-image').text("");
                }).fail(function (err) {
                    console.error(err);
                });
            });
        } else {
            $('#error-add-image').text("Por favor, complete todos los campos");
        }
    });





    // FORMULARIO TEXTO

    $('#add-text').click(function () {
        if (($('#title').val() != '' && $('#size-text').val() != "" && $('#size-text').val() != null) || ($('#story').val() != '' && $('#size-text').val() != "" && $('#size-text').val() != null)) {
            $('#add-text').addClass('d-none');
            $('#spinner-text').removeClass('d-none');

            fetch("../src/api/v1/save_text.php?title=" + encodeURIComponent($('#title').val()) + "&story=" + encodeURIComponent($('#story').val()) + "&size=" + encodeURIComponent($('#size-text').val()))
                .then((response) => response.json())
                .then((data) => {
                    if (data["data_title"]["title"] != "") {
                        tripContainer.appendChild(paintTitle(data["data_title"]["id"], data["data_title"]["title"], $('#size-text').val()));
                    }

                    if (data["data_story"]["story"] != "") {
                        tripContainer.appendChild(paintStory(data["data_story"]["id"], data["data_story"]["story"], $('#size-text').val()));
                    }

                    $('#title').val('');
                    $('#story').val('');
                    $('#size-text').val('');
                    $('#add-text').removeClass('d-none');
                    $('#spinner-text').addClass('d-none');
                    $('#error-add-text').text("");
                });
        } else {
            $('#error-add-text').text("Por favor, complete al menos un campo");
        }
    });





    // GUARDAR EL VIAJE

    $('#save-trip').click(function () {
        if (img_name != '' && $('#date').val() != '' && $('#place').val() != '' && img_name != null && $('#date').val() != null && $('#place').val() != null) {
            $('#save-trip').addClass('d-none');
            $('#spinner').removeClass('d-none');
            $croppie1.result({ type: 'base64', format: 'png' }).then(function (imgBase64) {
                $.ajax({
                    url: '../src/api/v1/save_trip.php',
                    method: 'POST',
                    data: { img: imgBase64, place: $('#place').val(), date: $('#date').val(), fname: img_name },
                    dataType: 'json'
                }).done(function (response) {
                    $('#place').val('');
                    $('#date').val('');

                    $croppie1.bind({ url: '' });
                    $('#save-trip').removeClass('d-none');
                    $('#spinner').addClass('d-none');
                    $('#error').text("");
                    console.log(response);
                }).fail(function (err) {
                    console.error(err);
                });
            });
        } else {
            $('#error').text("Por favor, complete todos los campos");
        }
    });
})





// MÉTODOS

function paintImage(id, date, url, size) {
    let image = document.createElement('miDiv');
    image.setAttribute("class", size + " mb-4 px-2 position-relative item-carrusel");
    image.innerHTML = `
                        <div class="card">
                            <img src="${url}" class="card-img-top contenido-carrusel">
                            <p class="card-text text-end text-secondary py-1 pe-2 contenido-carrusel">${date}</p>
                        </div>
                        <div class="overlay-carrusel">
                            <button class="btn btn-danger btn-sm eliminar-item" id-item="${id}">Eliminar</button>
                        </div>
                    `;

    return image;
}

function paintStory(id, story, size) {
    let text = document.createElement('miDiv');
    text.setAttribute("class", size + " mt-2 mb-3 px-2 position-relative item-carrusel");
    text.innerHTML = `
                        <p class="contenido-carrusel">${story}</p>
                        <div class="overlay-carrusel">
                            <button class="btn btn-danger btn-sm eliminar-item" id-item="${id}">Eliminar</button>
                        </div>
                    `;
                    
    return text;
}

function paintTitle(id, title, size) {
    let text = document.createElement('miDiv');
    text.setAttribute("class", size + " mb-3 mt-5 px-2 position-relative item-carrusel");
    text.innerHTML = `
                        <h2 class="contenido-carrusel">${title}</h2>
                        <div class="overlay-carrusel">
                            <button class="btn btn-danger btn-sm eliminar-item" id-item="${id}">Eliminar</button>
                        </div>
                    `;
                    
    return text;
}