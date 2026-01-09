const carouselSummer = document.getElementById("carousel-summers");
const carouselTrip = document.getElementById("carousel-trips");
const carouselImage = document.getElementById("carousel-images");


fetch("../src/api/v1/images.php?category=trip")
    .then(response => response.json())
    .then(data => {
        paintTrips(data['data'])
    });


    
fetch("../src/api/v1/images.php?category=summer")
    .then(response => response.json())
    .then(data => {
        paintSummers(data['data'])
    });



fetch("../src/api/v1/images.php?category=image")
    .then(response => response.json())
    .then(data => {
        paintImage(data['data'])
    });



paintImages("", "", "");





function paintTrips(images) {
    for (let i = 0; i < images.length; i += 3) {
        const group = images.slice(i, i + 3);

        const item = document.createElement("div");
        item.className = "carousel-item" + (i === 0 ? " active" : "");

        const row = document.createElement("div");
        row.className = "row justify-content-center";

        group.forEach(image => {
            const col = document.createElement("div");
            col.className = "col-md-4 d-flex align-items-center";

            col.innerHTML = `
                <div class="card mx-auto">
                    <img src="${image.url}" class="card-img-top" alt="${image.place}">
                    <div class="card-body">
                        <h5 class="card-title">${image.place}</h5>
                        <p class="card-text">Fecha: ${image.date}</p>
                    </div>
                </div>
            `;
            row.appendChild(col);
        });

        item.appendChild(row);
        carouselTrip.appendChild(item);
    }
}

function paintImage(images) {
    for (let i = 0; i < images.length; i += 3) {
        const group = images.slice(i, i + 3);

        const item = document.createElement("div");
        item.className = "carousel-item" + (i === 0 ? " active" : "");

        const row = document.createElement("div");
        row.className = "row justify-content-center";

        group.forEach(image => {
            const col = document.createElement("div");
            col.className = "col-md-4 d-flex align-items-center";

            col.innerHTML = `
                <div class="card mx-auto">
                    <img src="${image.url}" class="card-img-top" alt="${image.place}">
                    <div class="card-body">
                        <h5 class="card-title">${image.place}</h5>
                        <p class="card-text">Fecha: ${image.date}</p>
                    </div>
                </div>
            `;
            row.appendChild(col);
        });

        item.appendChild(row);
        carouselImage.appendChild(item);
    }
}

function paintSummers(images) {
    for (let i = 0; i < images.length; i += 3) {
        const group = images.slice(i, i + 3);

        const item = document.createElement("div");
        item.className = "carousel-item" + (i === 0 ? " active" : "");

        const row = document.createElement("div");
        row.className = "row justify-content-center";

        group.forEach(image => {
            const col = document.createElement("div");
            col.className = "col-md-4 d-flex align-items-center";

            col.innerHTML = `
                <div class="card mx-auto">
                    <img src="${image.url}" class="card-img-top" alt="${image.place}">
                    <div class="card-body">
                        <h5 class="card-title">${image.place}</h5>
                        <p class="card-text">Fecha: ${image.date}</p>
                    </div>
                </div>
            `;
            row.appendChild(col);
        });

        item.appendChild(row);
        carouselSummer.appendChild(item);
    }
}

function paintImages(place, maximumDate, minimumDate) {
    fetch("../src/api/v1/images.php?category=image")
        .then(response => response.json())
        .then(data => {
            document.getElementById('masonry').innerHTML = '';

            data['data'].forEach(image => {
                const figure = document.createElement('figure');
                figure.className = 'masonry-item';

                const img = document.createElement('img');
                img.src = image.url;

                const overlay = document.createElement('div');
                overlay.className = 'overlay';
                overlay.innerHTML = `<strong>${image.place}</strong><br>${image.date}`;

                figure.appendChild(img);
                figure.appendChild(overlay);
                document.getElementById('masonry').appendChild(figure);
            });
        });
}