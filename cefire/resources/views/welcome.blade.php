@extends('layouts.app')

@section('content')
		<div class="top-wrap uk-position-relative uk-light uk-background-secondary">
            <div class="uk-cover-container uk-light uk-flex uk-flex-middle top-wrap-height">
                <div class="uk-container uk-flex-auto uk-position-relative uk-margin uk-margin-large-top uk-margin-large-bottom" data-uk-parallax="y: 0,99; easing:0; opacity:0.0">
                    <div class="uk-width-1-2@s" data-uk-scrollspy="cls: uk-animation-slide-right-medium; target: > *; delay: 150">
                        <h6 class="uk-text-primary uk-margin-small-bottom">Benvingut!</h6>
                        <h1 class="uk-margin-remove-top">Intranet del CEFIRE de València</h1>
                        <p class="subtitle-text uk-visible@s">Aquesta pàgina és per a gestionar els horaris del centre del CEFIRE de València. A continuació teniu els enllaços per a accedir als diferents recursos.</p>
                        <button class="uk-button uk-button-primary uk-border-pill">Entra</button>
                        <a href="{{ route('login') }}" title="Entra" class="uk-button uk-button-primary uk-border-pill">Entra</a>
                    </div>
                </div>
                <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-srcset="/img/cef_port.png"
				data-sizes="100vw"
				data-src="https://picsum.photos/1200/900/?image=816" alt="" data-uk-cover data-uk-img data-uk-parallax="opacity: 0.3,0.1; easing:0"
				>
            </div>
		</div>
<div class="entrada_general">
<div class="uk-grid-column-small uk-grid-row-large uk-child-width-1-3@s uk-text-center uk-grid-match enlla" uk-grid>
    <div>
        <div class="buttons2">
                <div class="container2">
                    <a href="" class="btn2 effect04" data-sm-link-text="Antiga pàgina de gestió de centres" target="_blank"><span class="uk-flex uk-flex-middle"><i class="fa fa-graduation-cap fa-3x uk-margin-right" aria-hidden="true"></i> Control de centres</span></a>
                </div>
            </div>
    </div>
    <div>
        <div class="buttons2">
                <div class="container2">
                    <a href="" class="btn2 effect04" data-sm-link-text="Aplicació per a la reserva d'Aules" target="_blank"><span class="uk-flex uk-flex-middle"><i class="fa fa-check fa-3x uk-margin-right" aria-hidden="true"></i> Reserva d'Aules</span></a>
                </div>
            </div>
    </div>
    <div>
        <div class="buttons2">
                <div class="container2">
                    <a href="" class="btn2 effect04" data-sm-link-text="Espai per a enmagatzenar arxius" target="_blank"><span class="uk-flex uk-flex-middle"><i class="fa fa-cloud fa-3x uk-margin-right" aria-hidden="true"></i> Owncloud</span></a>
                </div>
            </div>
    </div>
    <div>
        <div class="buttons2">
                <div class="container2">
                    <a href="" class="btn2 effect04" data-sm-link-text="Realitzar videoconfènrecies online" target="_blank"><span class="uk-flex uk-flex-middle"><i class="fa fa fa-video fa-3x uk-margin-right" aria-hidden="true"></i> Jitsi Meet</span></a>
                </div>
            </div>
    </div>
    <div>
        <div class="buttons2">
                <div class="container2">
                    <a href="" class="btn2 effect04" data-sm-link-text="Arxius per a ús de l'administrador" target="_blank"><span class="uk-flex uk-flex-middle"><i class="fa fa-file fa-3x uk-margin-right" aria-hidden="true"></i> Arxius intranet</span></a>
                </div>
            </div>
    </div>
    <div>
        <div class="buttons2">
                <div class="container2">
                    <a href="" class="btn2 effect04" data-sm-link-text="Espai per a controlar la intranet del CEFIRE" target="_blank"><span class="uk-flex uk-flex-middle"><i class="fa fa-cogs fa-3x uk-margin-right" aria-hidden="true"></i> Proxmox</span></a>
                </div>
            </div>
    </div>
</div>
</div>


    {{-- <div class="uk-section uk-section-small uk-section-muted">
        <div class="uk-container">
            <div class="uk-child-width-1-2@m uk-text-center" uk-grid>
                <div class="uk-animation-toggle" tabindex="0">
                    <img class="uk-animation-stroke" width="400" height="400" src="img/a.svg" alt="" uk-svg="stroke-animation: true">
                </div>
                <div class="uk-animation-toggle" tabindex="0">
                    <img class="uk-animation-stroke uk-animation-reverse" width="400" height="400" src="img/a.svg" alt="" uk-svg="stroke-animation: true">
                </div>
            </div>
            <h1 class="uk-heading-divider">UIkit frontend UI preset for Laravel</h1>
            <p>
                Congratulations, you've successfuly installed the UIkit preset for
                Laravel. Have a browse through the links below for inspiration on
                how to work with Laravel, UIkit, and Vue.js. Happy coding!
            </p>
            <div class="uk-grid" data-uk-grid data-uk-height-match="target:.uk-card">
                <div class="uk-width-1-3@l">
                    <div class="uk-card uk-card-default uk-card-body uk-card-hover">
                        <h3 class="uk-card-title">Laravel</h3>
                        <ul class="uk-list uk-list-divider">
                            @include('laravel')
                        </ul>
                    </div>
                </div>
                <div class="uk-width-1-3@l">
                    <div class="uk-card uk-card-primary uk-card-body uk-card-hover">
                        <h3 class="uk-card-title">UIkit</h3>
                        <ul class="uk-list uk-list-divider">
                            @include('uikit')
                        </ul>
                    </div>
                </div>
                <div class="uk-width-1-3@l">
                    <div class="uk-card uk-card-secondary uk-card-body uk-card-hover">
                        <h3 class="uk-card-title">Vue.js</h3>
                        <ul class="uk-list uk-list-divider">
                            @include('vuejs')
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

@endsection
