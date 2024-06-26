export async function fetch_organisations(perPage = 20, page=0) {

    let url = new URL("https://oveda.de/api/v1/organizations");
    let params = new URLSearchParams(url.search)

    if(typeof(perPage) === "number") {
        params.append("per_page", perPage)
    }

    if(typeof(page) === "number") {
        params.append("page", page)
    }

    const response = await fetch(url, {
        headers: {
            ContentType: "application/json"
        }
    });

    response.json().then(data => {
        return {
            has_prev: data.has_prev,
            has_next: data.has_next,
            data: data.items
        }
    }, error => {
        return error
    })
    
}