document.getElementById("graficar").style.display = 'none';
document.getElementById("btn").style.display = '';

function cargarGrafico()
{
    var inicio = "";
    var fin = "";
    var ano = "";
    var valor = "";
    var v = "";
    var codigo = "";

    inicio = document.getElementById("start").value; //fecha de inicio
    fin = document.getElementById("end").value; // fecha fin
    ano = inicio.slice(0, 4); // rescatar solo el año
    // console.log("año->" + ano); // comprobar
    valor = document.getElementById("cod").value; //entregar value del commbobox 
    v = document.getElementById("cod");
    codigo = v.options[v.selectedIndex].text; //entregar el nombre del value


    if (inicio == "" || fin == "")
    {
        swal({
            title: "Revisar fechas seleccionadas!",
            text: "Debe ingresar fecha de inicio y de fin",
            icon: "info"
        });
    } else
    {
        var valorIni;
        var valorFin;

        if (inicio > fin)
        {
            valorIni = fin; //se guarda la fecha menor en valor
            valorFin = inicio;
            inicio = valorIni;
            fin = valorFin;
            // se pasa a igual la
        }
        // console.log("inicio->" + inicio + " fin->" + fin);
        // https://mindicador.cl/api/{tipo_indicador}/{yyyy} -> formato ejemplo de consulta
        console.log(valor);
        swal({
            title: "Realizado!",
            text: "Graficos Generados",
            icon: "success"
        });
        let url = "https://mindicador.cl/api/" + valor + "/" + ano;
        console.log(url);
        var fecha = [];
        var valor = [];

        var ctx = document.getElementById('myChart')
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                datasets: [{
                    label: codigo,
                    backgroundColor: ['#6bf1ab', '#63d69f', '#438c6c', '#509c7f', '#1f794e', '#34444c', '#90CAF9', '#64B5F6', '#42A5F5', '#2196F3', '#0D47A1', '#63d69f', '#438c6c', '#509c7f', '#1f794e', '#34444c', '#90CAF9', '#64B5F6', '#42A5F5', '#2196F3', , '#63d69f', '#438c6c', '#509c7f', '#1f794e', '#34444c', '#90CAF9', '#64B5F6', '#42A5F5', '#2196F3', , '#63d69f', '#438c6c', '#509c7f', '#1f794e', '#34444c', '#90CAF9', '#64B5F6', '#42A5F5', '#2196F3', , '#63d69f', '#438c6c', '#509c7f', '#1f794e', '#34444c', '#90CAF9', '#64B5F6', '#42A5F5', '#2196F3', '#63d69f', '#438c6c', '#509c7f', '#1f794e', '#34444c', '#90CAF9', '#64B5F6', '#42A5F5', '#2196F3', '#63d69f', '#438c6c', '#509c7f', '#1f794e', '#34444c', '#90CAF9', '#64B5F6', '#42A5F5', '#2196F3', '#63d69f', '#438c6c', '#509c7f', '#1f794e', '#34444c', '#90CAF9', '#64B5F6', '#42A5F5', '#2196F3', '#63d69f', '#438c6c', '#509c7f', '#1f794e', '#34444c', '#90CAF9', '#64B5F6', '#42A5F5', '#2196F3', '#63d69f', '#438c6c', '#509c7f', '#1f794e', '#34444c', '#90CAF9', '#64B5F6', '#42A5F5', '#2196F3', , '#63d69f', '#438c6c', '#509c7f', '#1f794e', '#34444c', '#90CAF9', '#64B5F6', '#42A5F5', '#2196F3', '#63d69f', '#438c6c', '#509c7f', '#1f794e', '#34444c', '#90CAF9', '#64B5F6', '#42A5F5', '#2196F3', '#63d69f', '#438c6c', '#509c7f', '#1f794e', '#34444c', '#90CAF9', '#64B5F6', '#42A5F5', '#2196F3', '#63d69f', '#438c6c', '#509c7f', '#1f794e', '#34444c', '#90CAF9', '#64B5F6', '#42A5F5', '#2196F3', '#63d69f', '#438c6c', '#509c7f', '#1f794e', '#34444c', '#90CAF9', '#64B5F6', '#42A5F5', '#2196F3',],
                    borderColor: ['black'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
            }
        })

        fetch(url)
            .then(response => response.json())
            .then(datos => mostrar(datos))
            .catch(error => console.log(error))


        const mostrar = (indica) =>
        {
            indica.serie.forEach(e =>
            {
                if (e.fecha >= inicio && e.fecha <= fin)
                {
                    console.log(e.fecha);
                    myChart.data['labels'].push(e.fecha.slice(0, 10))
                    myChart.data['datasets'][0].data.push(e.valor)
                    myChart.update()
                }
            });
            console.log(myChart.data)
        }
        document.getElementById("graficar").style.display = '';
         document.getElementById("btn").style.display = 'none';
    }
}
function simbolo(x)
{

    if (x == "Pesos")
    {
        x = "$"
        return x;
    } else if (x == "Porcentaje")
    {
        x = "%"
        return x;
    } else
    {
        x = "US $";
        return x;
    }

}




