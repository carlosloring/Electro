var idProductoActual = -1;//producto visualizado para la reseña
var confirmacion=1;

(function($) {
	"use strict"

	// Mobile Nav toggle
	$('.menu-toggle > a').on('click', function (e) {
		e.preventDefault();
		$('#responsive-nav').toggleClass('active');
	})

	// Fix cart dropdown from closing
	$('.cart-dropdown').on('click', function (e) {
		e.stopPropagation();
	});

	/////////////////////////////////////////

    
    //gestionar el click de envio resena:
    $('#enviarResena').on('click', function(e){
        e.preventDefault();
        enviarResena();//funcion abajo del todo
    })
    
    
	// Products Slick
	$('.products-slick').each(function() {
		var $this = $(this),
				$nav = $this.attr('data-nav');

		$this.slick({
			slidesToShow: 4,
			slidesToScroll: 1,
			autoplay: true,
			infinite: true,
			speed: 300,
			dots: false,
			arrows: true,
			appendArrows: $nav ? $nav : false,
			responsive: [{
	        breakpoint: 991,
	        settings: {
	          slidesToShow: 2,
	          slidesToScroll: 1,
	        }
	      },
	      {
	        breakpoint: 480,
	        settings: {
	          slidesToShow: 1,
	          slidesToScroll: 1,
	        }
	      },
	    ]
		});
	});

	// Products Widget Slick
	$('.products-widget-slick').each(function() {
		var $this = $(this),
				$nav = $this.attr('data-nav');

		$this.slick({
			infinite: true,
			autoplay: true,
			speed: 300,
			dots: false,
			arrows: true,
			appendArrows: $nav ? $nav : false,
		});
	});

	/////////////////////////////////////////

	// Product Main img Slick
	$('#product-main-img').slick({
    infinite: true,
    speed: 300,
    dots: false,
    arrows: true,
    fade: true,
    asNavFor: '#product-imgs',
  });

	// Product imgs Slick
  $('#product-imgs').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: true,
    centerMode: true,
    focusOnSelect: true,
		centerPadding: 0,
		vertical: true,
    asNavFor: '#product-main-img',
		responsive: [{
        breakpoint: 991,
        settings: {
					vertical: false,
					arrows: false,
					dots: true,
        }
      },
    ]
  });

    
    $('.product-preview').click(function(){//JQuery hacer clic en foto carrusel se actualicen los datos para que aparezca la imagen clicada
   
        var id=$(this).attr('idProducto');
         cargaVistaProducto(id);
        
    });
    
    
    
	// Product img zoom
	var zoomMainProduct = document.getElementById('product-main-img');
	if (zoomMainProduct) {
		$('#product-main-img .product-preview').zoom();
	}

	/////////////////////////////////////////

	// Input number
	$('.input-number').each(function() {
		var $this = $(this),
		$input = $this.find('input[type="number"]'),
		up = $this.find('.qty-up'),
		down = $this.find('.qty-down');

		down.on('click', function () {
			var value = parseInt($input.val()) - 1;
			value = value < 1 ? 1 : value;
			$input.val(value);
			$input.change();
			updatePriceSlider($this , value)
		})

		up.on('click', function () {
			var value = parseInt($input.val()) + 1;
			$input.val(value);
			$input.change();
			updatePriceSlider($this , value)
		})
	});

	var priceInputMax = document.getElementById('price-max'),
			priceInputMin = document.getElementById('price-min');

	priceInputMax.addEventListener('change', function(){
		updatePriceSlider($(this).parent() , this.value)
	});

	priceInputMin.addEventListener('change', function(){
		updatePriceSlider($(this).parent() , this.value)
	});

	function updatePriceSlider(elem , value) {
		if ( elem.hasClass('price-min') ) {
			console.log('min')
			priceSlider.noUiSlider.set([value, null]);
		} else if ( elem.hasClass('price-max')) {
			console.log('max')
			priceSlider.noUiSlider.set([null, value]);
		}
	}

	// Price Slider
	var priceSlider = document.getElementById('price-slider');
	if (priceSlider) {
		noUiSlider.create(priceSlider, {
			start: [1, 999],
			connect: true,
			step: 1,
			range: {
				'min': 1,
				'max': 999
			}
		});

		priceSlider.noUiSlider.on('update', function( values, handle ) {
			var value = values[handle];
			handle ? priceInputMax.value = value : priceInputMin.value = value
		});
	}

})(jQuery);

function cargaVistaProducto(id){//Se cargara al linkar en Categoria (pag ppal) la pagina y cada vez que se elija un producto diferente
  idProductoActual=id;//carga el producto que se esta viendo
  $('#alertaFormulario').hide();//ocultar alerta del formulario enviado
  $.ajax({//Ajax para que la pagina no se recargue al hacer clic en las imagenes del carrusel
            type: 'post',//metodo
            url: 'Gestor.php',//Llamamos a esta direccion
            data: {//parametros post que se envian al enlace.
                accion:'obtenerProducto',
                idProducto:id
            },
            dataType: "json",//Espero como respuesta es tipo Json
            success: function(data) {//Lo que hace Ajax si funciona correctamente la llamada
                //data es la respuesta textual a la peticion
                $('#tab-1').trigger('click');
                $('.product-price').html(data.precioRebajado);
                $('.product-old-price').html(data.precioNormal);
                if(parseInt(data.stock)>0) {
                    
                    $('.product-available').html("<b>En almacen</b>");
                }else{
                    
                    $('.product-available').html("<b>Agotado</b>");
                }
                
                $('.product-description-short').html(data.descripcionCorta);
                
                $('.product-description').html(data.descripcion);
                
                $('.product-details').html(data.detalles);
                
                $('.product-name').html(data.nombre);
            },
            error: function(data) {
                console.error(JSON.stringify(data)+"error");//En caso de fallo
}
        });
        //Hacemos la llamada para las reseñas
        $.ajax({//Ajax para que la pagina no se recargue al hacer clic en las imagenes del carrusel
            type: 'post',//metodo
            url: 'Gestor.php',//Llamamos a esta direccion
            data: {//parametros post que se envian al enlace.
                accion:'obtenerResena',
                idProducto:id
            },
            dataType: "json",//Espero como respuesta es tipo Json
            success: function(data) {//Array con todas las reseñas del producto//Lo que hace Ajax si funciona correctamente la llamada
                //data es la respuesta textual a la peticion
                
                //alert (JSON.stringify(data)); //Para saber si obtenemos los datos
                
                $('#numResenas').html('Reseñas ('+data.length+')');
                var listaResenas='';
                
                    $('.Reseñas').html('');//Elimina codigo html del objeto con clase css Reseñas para refrescar
                
                var sumas = [0,0,0,0,0];//para puntuacion con estrellas
                
               for(var i=0; i<data.length; i++){//sacamos reseña por reseña
                   
                   sumas[data[i].puntuacion-1]++;//sumar una ocurrencia de calificacion con estrellas
                   
                    var fecha=new Date(data[i].fecha);//convertimos el string de la fecha en date
                    var codigo='<li class="itemResena">'+//Codigo de la reseña
                    '<div class="review-heading">'+
                        '<h5 class="name">'+data[i].usuarioResena+'</h5>'+
                        '<p class="date">'+fecha.toLocaleString()+' </p>'+//formato de fecha
                        '<div class="review-rating">';
                   
                   var j=0;
                   for(j=0;j<parseInt(data[i].puntuacion);j++){//poner tantas estrellas pequeñas rellenascomo me dice "puntuacion" 
                       
                       codigo+='<i class="fa fa-star"></i>';
                   }
                   
                   for(j=parseInt(data[i].puntuacion);j<5;j++){//poner las restantes estrellas pequeñasvacias en relacion a "puntuacion"
                       
                       
                      codigo+= '<i class="fa fa-star-o empty"></i>';
                      
                   }
                          
                    codigo+='</div>'+
                    '</div>'+
                    '<div class="review-body">'+
                        '<p>'+data[i].comentario+'</p>'+//comentario del usuario
                    '</div><hr>'+
                '</li>';   
                   listaResenas+=codigo;//Concatenamos mas codigo html del css Reseñas
                   
               } 
                
                
                var suma = (sumas[0]+sumas[1]+sumas[2]+sumas[3]+sumas[4]);//barras de estado calificaciones tb para paginacion
                
                codigo='';
                for(var i=1;i<=Math.ceil(suma/4);i++){//paginacion
                    
                    codigo+='<li><a onclick="paginarResena('+i+')">'+i+'</a></li>';
                    
                }
                $('.Reseñas-pagination').html(codigo);
                //$( '.Reseñas-pagination' ).first().first()trigger( 'click' );//(para lanzar el click para la paginacion de los 4 comeentarios)
                $('#sum1').html(sumas[0]);//estrellas
                $('#sum2').html(sumas[1]);
                $('#sum3').html(sumas[2]);
                $('#sum4').html(sumas[3]);
                $('#sum5').html(sumas[4]);
                
                var media = (sumas[0]+sumas[1]*2+sumas[2]*3+sumas[3]*4+sumas[4]*5)/data.length;//media de las calificaciones con estrellas
                
                $('#media').html(media.toFixed(1));
                codigo='';
                var j=0;
                   for(j=0;j<Math.floor(media);j++){//poner tantas estrellas relllenas grandes como dice media
                       
                       codigo+='<i class="fa fa-star"></i>';
                   }
                   
                   for(j=Math.floor(media);j<5;j++){//poner las restantes estrellas grandes vacias en relacion a la media
                       
                       
                      codigo+= '<i class="fa fa-star-o empty"></i>';
                      
                   }
                
                $('#calificacion').html('');
                $('#calificacion').html(codigo);
                $('#prod-rating').html(codigo);
                
                
                $('#lineaProgreso1').width((sumas[0]*100/suma)+'%');
                $('#lineaProgreso2').width((sumas[1]*100/suma)+'%');
                $('#lineaProgreso3').width((sumas[2]*100/suma)+'%');
                $('#lineaProgreso4').width((sumas[3]*100/suma)+'%');
                $('#lineaProgreso5').width((sumas[4]*100/suma)+'%');
                
                
                
                
                
                
                
                
                
                
                $('.Reseñas').html(listaResenas);//Aplicamos el codigo listaResenas a la etiqueta html de la clase css Reseñas
                
                
                paginarResena(1);//para que pagine los comentarios de 4 en 4, 1 porque soon las primeras cuatro
            },
            
            error: function(data) {
                console.error(JSON.stringify(data)+"error");//En caso de fallo
}
        });  
    
    
    
    
}
function enviarResena(){
    
       $.ajax({//Ajax para que la pagina no se recargue al hacer clic en las imagenes del carrusel
            type: 'post',//metodo
            url: 'Gestor.php',//Llamamos a esta direccion
            data: {//parametros post que se envian al enlace.
                accion:'enviarResena',
                puntuacion:$('input[name=rating]:checked', '#formResena').val(),
                texto:$('#textoResena').val(),
                email:$('#emailResena').val(),
                nombre:$('#nombreResena').val(),
                idProducto:idProductoActual
            },
            dataType: "json",//Espero como respuesta es tipo Json
           
            success: function(data) 
           {
            $('#alertaFormulario').removeClass('alert-danger');
            $('#alertaFormulario').removeClass('alert-success');//Le quito primero el estilo que tuviera para ponerle luego el que le toca
            $('#alertaFormulario').addClass('alert-success');
            $('#alertaFormulario').html('¡Formulario enviado!');
            $('#alertaFormulario').show();
           },//Lo que hace Ajax si funciona correctamente la llamada
            error:function(data){
            $('#alertaFormulario').removeClass('alert-danger');
            $('#alertaFormulario').removeClass('alert-success');
            $('#alertaFormulario').addClass('alert-danger');
            $('#alertaFormulario').html('¡Hay errores en el formulario!');
            $('#alertaFormulario').show();
            }
       });
    
}

function paginarResena(numPagina){//oculta todas las reseñas para luego mostrar lass que tocan de 4 en 4 o el resto
   $('.itemResena').hide();
    for(var i=(numPagina-1)*4;i<numPagina*4;i++){
        
        $('.itemResena').eq(i).show();
    }
    
}

function anadir(pedido,articulo){
    var cantidad = parseInt($('#numcarrito').val());
    if(cantidad==0){
        return;
    }
    $.ajax({//Ajax para que la pagina no se recargue al hacer clic en las imagenes del carrusel
            type: 'post',//metodo
            url: 'Gestor.php',//Llamamos a esta direccion
            data: {//parametros post que se envian al enlace.
            accion: 'anadir',  
                idpedido:pedido,
                idProducto:articulo,
                cantidad:$('#numcarrito').val()
            },
            
           
            success: function(data){
            console.log(data);
            var carrito=JSON.parse(data);
                $('#carritocant').html(carrito.length);
                console.log(data);
                location.reload();
            },
        error: function (data){
            
        }
    });
}

function comprar(pedido, idUsuario){
    if($('#terms').is(':checked')==false){
        return;
    }
    
    $.ajax({//Ajax para que la pagina no se recargue al hacer clic en las imagenes del carrusel
            type: 'post',//metodo
            url: 'Gestor.php',//Llamamos a esta direccion
            data: {//parametros post que se envian al enlace.
            accion: 'comprar',  
                idpedido:pedido,
                idUsuario:parseInt(idUsuario) //<----Añadir el usuario
            },
            
           
            success: function(data){
            console.log(data);
                
                location="checkout.php?compra=1";
            },
        error: function (data){
            
        }
    });
}
function quitar(idProducto, idPedido){
 
    $('#quitarpedido').modal({show:true});
    $("#quitarpedido").on('hidden.bs.modal', function(){
    if(confirmacion==0){
    $.ajax({//Ajax para que la pagina no se recargue al hacer clic en las imagenes del carrusel
            type: 'post',//metodo
            url: 'Gestor.php',//Llamamos a esta direccion
            data: {//parametros post que se envian al enlace.
            accion: 'quitar',  
                idPedido:idPedido,
                idProducto:idProducto //<----Añadir el usuario
            },
            
           
            success: function(data){
            console.log(data);
                confirmacion=1;
                location.reload();
            },
        error: function (data){
            
        }
    });
    
     } 
    });
}

    
function suscribirse(){
    var email=document.getElementById('mailnewsletter').value;
    if(email!=""){
    $.ajax({//Ajax para que la pagina no se recargue al hacer clic en las imagenes del carrusel
            type: 'post',//metodo
            url: 'Gestor.php',//Llamamos a esta direccion
            data: {//parametros post que se envian al enlace.
            accion: 'suscribirse',  
                email:email
            },
            
           
            success: function(data){
            console.log(data);

                $('#newslettermod').modal({show:true});
            },
        error: function (data){
            
        }
    });
    }
}

function confirmarquitar(){
    confirmacion=0;
}


