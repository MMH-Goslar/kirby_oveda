<?php


?>


        <div class="events mt-4 mb-2">

            <h1> Veranstaltungen </h1>

            <div class="list  bg-white grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-3 gap-3 events" data-page="1">


            </div>
            <button class="load-more" accesskey="m">Mehr anzeigen</button>
    
                

             <p class="text-black"> powered by: <a class="text-gold" href="https://oveda.de">Oveda</a> Goslar </p>





        </div>
<script>
    const element = document.querySelector('.events');
    const button  = document.querySelector('.load-more');
    let page      = parseInt(element.getAttribute('data-page'));

    const fetchProjects = async () => {
    let url = `${window.location.href.split('#')[0]}.json/page:${page}`; // see info
    try {
        const response       = await fetch(url);
        const { html, more } = await response.json();
        button.hidden        = !more;
        element.insertAdjacentHTML('beforeend', html);
        page++;
    } catch (error) {
        console.log('Fetch error: ', error);
    }
    }

    button.addEventListener('click', fetchProjects);
    if(element.childElementCount == 0) {
        fetchProjects();
    }
</script>