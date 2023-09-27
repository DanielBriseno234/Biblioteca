window.addEventListener("load",function(){
    formulario = document.formulario;
    imagen = document.formulario.imagen;
    campoError = document.getElementById("error");
		
		imagen.addEventListener("input",function(){
			campoError.innerHTML= "";
		});

    imagen.addEventListener("change",envioAutomatico);
});


function enviarFormulario(e){
    e = e || window.event;	//compatibilidad explorer
};

function envioAutomatico(){
    formulario.addEventListener("submit",enviarFormulario);
    formulario.submit();
}

