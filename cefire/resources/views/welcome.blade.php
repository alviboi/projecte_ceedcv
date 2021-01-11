@extends('layouts.app')

@section('content')
		<div class="top-wrap uk-position-relative uk-light uk-background-secondary">
            <div class="uk-cover-container uk-flex uk-flex-middle">
                <div class="uk-container uk-flex-auto uk-position-relative uk-margin uk-margin-large-top uk-margin-large-bottom" data-uk-parallax="y: 0,99; easing:0; opacity:0.0">
                    <div class="uk-width-1-2@s" data-uk-scrollspy="cls: uk-animation-slide-right-medium; target: > *; delay: 150">
                        <h6 class="uk-text-primary uk-margin-small-bottom">Benvingut!</h6>
                        <h1 class="uk-margin-remove-top">Intranet del CEFIRE de València</h1>
                        <p class="subtitle-text uk-visible@s">Aquesta pàgina és per a gestionar els horaris del centre del CEFIRE de València. A continuació teniu els enllaços per a accedir als diferents recursos.</p>
                    </div>
                </div>
                <img data-srcset="/img/cef_port.png"
				data-sizes="100vw"
				data-src="https://picsum.photos/1200/900/?image=816" alt="" data-uk-cover data-uk-img data-uk-parallax="opacity: 0.2,0.1; easing:0"
				>
            </div>
		</div>
<div class="entrada_general">
<div class="uk-grid-column-small uk-grid-row-large uk-child-width-1-3@s uk-text-center uk-grid-match enlla" uk-grid>
    <div>
        <div class="buttons2">
                <div class="container2">
                    <a href="/consultacentres" class="btn2 effect04" data-sm-link-text="Antiga pàgina de gestió de centres" target="_blank"><span class="uk-flex uk-flex-middle"><i class="fa fa-graduation-cap fa-3x" aria-hidden="true"></i> Control de centres</span></a>
                </div>
            </div>
    </div>
    <div>
        <div class="buttons2">
                <div class="container2">
                    <a href="http://128.0.0.240/reserva.php" class="btn2 effect04" data-sm-link-text="Aplicació per a la reserva d'Aules" target="_blank"><span class="uk-flex uk-flex-middle"><i class="fa fa-check fa-3x" aria-hidden="true"></i> Reserva d'Aules</span></a>
                </div>
            </div>
    </div>
    <div>
        <div class="buttons2">
                <div class="container2">
                    <a href="http://128.0.0.231/nextcloud/" class="btn2 effect04" data-sm-link-text="Espai per a enmagatzenar arxius" target="_blank"><span class="uk-flex uk-flex-middle"><i class="fa fa-cloud fa-3x" aria-hidden="true"></i> Nextcloud</span></a>
                </div>
            </div>
    </div>
    <div>
        <div class="buttons2">
                <div class="container2">
                    <a href="https://128.0.0.231:82/" class="btn2 effect04" data-sm-link-text="Realitzar videoconfènrecies online" target="_blank"><span class="uk-flex uk-flex-middle"><i class="fa fa fa-video fa-3x" aria-hidden="true"></i> Jitsi Meet</span></a>
                </div>
            </div>
    </div>
    <div>
        <div class="buttons2">
                <div class="container2">
                    <a href="http://128.0.0.240/gesform/" class="btn2 effect04" data-sm-link-text="Arxius per a ús de l'administrador" target="_blank"><span class="uk-flex uk-flex-middle"><i class="fa fa-file fa-3x" aria-hidden="true"></i> Arxius intranet</span></a>
                </div>
            </div>
    </div>
    <div>
        <div class="buttons2">
                <div class="container2">
                    <a href="http://128.0.0.240/gesform/" class="btn2 effect04" data-sm-link-text="Espai per a controlar la intranet del CEFIRE" target="_blank"><span class="uk-flex uk-flex-middle"><i class="fa fa-cogs fa-3x" aria-hidden="true"></i> Proxmox</span></a>
                </div>
            </div>
    </div>
</div>
</div>

@endsection
