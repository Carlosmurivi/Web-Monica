<footer class="d-flex flex-wrap bg-blue">
    <div class="d-flex text-center col-12 mb-4">
        <img src="images/logo.png" class="mt-2 ms-2" width="auto" height="50">
    </div>
    <h4 id="counter" class="col-12 text-center white mb-4"></h4>
    <p class="col-12 text-center white">
        &copy;<?php echo date("Y"); ?> Todos los derechos reservados a la niña de mis sueños
    </p>

</footer>

<script>
    function updateCounter() {
        const date = new Date("2022-07-23T00:00:00");
        const now = new Date();

        let years = now.getFullYear() - date.getFullYear();
        let months = now.getMonth() - date.getMonth();
        let days = now.getDate() - date.getDate();

        if (days < 0) {
            months--;
            const previousMonth = new Date(now.getFullYear(), now.getMonth(), 0).getDate();
            days += previousMonth;
        }
        if (months < 0) {
            years--;
            months += 12;
        }

        const hours = now.getHours();
        const minutes = now.getMinutes();
        const seconds = now.getSeconds();

        document.getElementById("counter").innerText =
            `Nos conocemos desde hace ${years} años, ${months} meses, ${days} días, ${hours} horas, ${minutes} minutos y ${seconds} segundos juntos`;
    }
    setInterval(updateCounter, 1000);
    updateCounter();

</script>