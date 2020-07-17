const form = document.getElementById('form')
const mostrar = document.getElementById('btnMostrar')
const table = document.getElementById('table')

mostrar.addEventListener('click',()=>{

    getData();
})



form.addEventListener('submit', (e) => {
    e.preventDefault()
    sendDataFetch(form)
    restFormulario();

})


//funcion de los datos del formulario
/*const sendData = (data) => {
    let xhr
    if (window.XMLHttpRequest){
        xhr = new XMLHttpRequest()
    } else{
        xhr = new ActiveXObject("Microsoft.XMLHTTP")
    } 

    xhr.open('POST', 'server.php');

    if(xhr.response == 200){
        alert("Datos enviados correctamente");
    }
    

    const formData = new FormData(data)
    console.log(formData);
    xhr.send(formData)
}*/

//Mostrar Datos
const getData = () =>{

    fetch('php/mostrarDatos.php')
    .then(res => res.ok == true ? Promise.resolve(res) : Promise.reject(res))
    .then(res => res.json())
    .then(res => {
        
        if(res != "" ){


        const fragment = document.createDocumentFragment();

        for(const heroe of res){

            const rowBody = document.createElement('TBODY')
            const row = document.createElement('TR')
            const Id = document.createElement('TD')
            const Titulo = document.createElement('TD')
            const Cuerpo = document.createElement('TD')
            const Bottom_1 = document.createElement('TD')
            const Bottom_2 = document.createElement('TD')
                
            
            
            Id.textContent = heroe.id
            Titulo.textContent = heroe.title
            Cuerpo.textContent = heroe.body

    
  
            rowBody.append(row)
            row.append(Id)
            row.append(Titulo)
            row.append(Cuerpo)
            row.append(Bottom_1)
            fragment.append(rowBody)

        }
        
        table.append(fragment)


    }



    })
}






//Limpia el formulario
const restFormulario = () =>{
    let name = document.getElementById('txtNombre').value = "";
    let body = document.getElementById('txtCuerpo').value = "";
    
}
   


//envio de datos por fetch
const sendDataFetch = (data) =>{

    const datosFormulario = new FormData(data)

   /* console.log(datosFormulario.get('txtNombre'));
    console.log(datosFormulario.get('txtCuerpo'));
*/
    fetch('php/server.php',{
        method : 'POST',
        body : datosFormulario,
    })
    .then(res => res.json())
    .then(json =>{
        //En caso de quew se cumpla la condicion

        if(json === 'SUCCESS'){
        Swal.fire(
            'Good job!',
            'Se han insertado de forma correcta los datos',
            'success'
          ) 

        }else{
            //En caso de que exista un error
            Swal.fire(
                'Bad job!',
                'No se ha encontrado un servidor de respuesta verifica tu fuente',
                'error'
            )
        }
           console.log(json);
    })


};