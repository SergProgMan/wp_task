let url = 'http://localhost/task/wp-json/starter/v1';

makeRequest(url, getEndpoints);




function getEndpoints(data){
    var routes = data.routes;
    let namespaces = Object.entries(routes);
    namespaces.forEach(element => {
        const app = document.getElementById('endpoints');
        console.log(element);
        if(element){
            let link = element[1]._links;
            let url = Object.entries(link);
            let endpoint = url[0][1];
            const a = document.createElement('a');
            a.href = "#";
            a.textContent = endpoint;
            let attr = 'event.preventDefault(); showResults("' + endpoint + '")';
            a.setAttribute('onclick', attr);
            //console.log(a);
            app.appendChild(a);

            var mybr = document.createElement('br');
            app.appendChild(mybr);
        }        
    });
}


function showResults(data){
    const results = document.getElementById('results');
    var res = new XMLHttpRequest();
    res.open('GET', data, true);
    res.onload = function() {
        // Begin accessing JSON data here
        var data = JSON.parse(this.response);
        let text = JSON.stringify(data);
        results.innerHTML = text;
    }
    res.send();
    
}

function makeRequest(url, func){
    var request = new XMLHttpRequest();
    request.open('GET', url, true);
    request.onload = function() {
        // Begin accessing JSON data here
        var data = JSON.parse(this.response);
        //console.log(data);     
        func(data);         
    }
    request.send();
}

