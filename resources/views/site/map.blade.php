@extends('site.layouts.app')
@section('site.title')
    @lang('site.home')
@endsection
@section('site.css')
    <style>
        .flaticon-love.active {
            color: red;
        }
    </style>
    <link rel="stylesheet" href="{{ asset("site/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset("site/css/style.css") }}">
    <link rel="stylesheet" href="{{ asset("site/css/responsive.css") }}">
    {{--<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>--}}
@endsection
@section('site.content')
    <div class="body_content">
        <!-- Listing Grid View -->
        <section id="feature-property" class="our-listing-list pt0 pb0">
            <div class="container-fluid">
                <div class="row">
                    {{--<div class="col-xl-6">
                        <div class="half_map_area_content">
                            <div class="row" id="listing-area"></div>
                        </div>
                    </div>--}}
                    <div class="col-xl-12">
                        <div class="half_map_area_content">
                            <div class="row" id="listing-area"></div>
                        </div>
                        <div class="half_map_area">
                            <div class="home_two_map">
                                <div class="map-canvas half_style" id="map" data-map-zoom="9" data-map-scroll="true"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('site.js')
    <!-- Wrapper End -->
    <script src="{{ asset("site/js/jquery-3.6.0.js") }}"></script>
    <script src="{{ asset("site/js/jquery-migrate-3.0.0.min.js") }}"></script>
    <script src="{{ asset("site/js/popper.min.js") }}"></script>
    <script src="{{ asset("site/js/bootstrap.min.js") }}"></script>
    <script src="{{ asset("site/js/jquery.mmenu.all.js") }}"></script>
    <script src="{{ asset("site/js/ace-responsive-menu.js") }}"></script>
    <script src="{{ asset("site/js/bootstrap-select.min.js") }}"></script>
    <script src="{{ asset("site/js/snackbar.min.js") }}"></script>
    <script src="{{ asset("site/js/simplebar.js") }}"></script>
    <script src="{{ asset("site/js/parallax.js") }}"></script>
    <script src="{{ asset("site/js/scrollto.js") }}"></script>
    <script src="{{ asset("site/js/jquery-scrolltofixed-min.js") }}"></script>
    <script src="{{ asset("site/js/jquery.counterup.js") }}"></script>
    <script src="{{ asset("site/js/wow.min.js") }}"></script>
    <script src="{{ asset("site/js/progressbar.js") }}"></script>
    <script src="{{ asset("site/js/slider.js") }}"></script>
    <script src="{{ asset("site/js/timepicker.js") }}"></script>
    <!-- Google Maps -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8M9rUVW_Og-Z8sTfQSA5HUgRbd4WyW0w&amp;callback=initMap"></script>
    <script src="{{ asset("site/js/infobox.min.js") }}"></script>
    <script src="{{ asset("site/js/markerclusterer.js") }}"></script>
{{--    <script src="{{ asset("site/js/maps.js") }}"></script>--}}
    <!-- Custom script for all pages -->
    <script src="{{ asset("site/js/script.js") }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function initMap() {
            // Xəritəni burada yarat və konfiqurasiya et
            const map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: 40.4093, lng: 49.8671 }, // Bakı koordinatları
                zoom: 12,
            });
        }
        var infoBox_ratingType='star-rating';(function($){"use strict";function mainMap() {var ib=new InfoBox(); function locationData (locationImg, locationRating, locationRatingCounter, locationURL, locationTitle, locationAddress, locationPhone, locationColor, locationIcon, locationName, locationStatus, ) {return(''+
            '<div class="map-listing-item">'+
            '<div class="inner-box">'+
            '<div class="infoBox-close"><i class="fa fa-times"></i></div>'+
            '<div class="image-box">'+
            '<a href="'+locationURL+'"><figure class="image"><img src="'+locationImg+'" alt=""></figure></a>'+
            '<div class="content">'+
            '<div class="'+infoBox_ratingType+'" data-rating="'+locationRating+'"><div class="rating-counter">('+locationRatingCounter+' reviews)</div></div>'+
            '<h3><a href="'+locationURL+'">' + locationTitle + '<span class="icon icon-verified"></span></a></h3>'+
            '<ul class="info">'+
            '<li><span class="flaticon-phone"></span>' +locationPhone+ '</li>'+
            '<li><span class="flaticon-pin"></span>' +locationAddress+ '</li>'+
            '</ul>'+
            '</div>'+
            '</div>'+
            '<div class="bottom-box">'+
            '<div class="places"><div class="place '+ locationColor +'"><span class="icon '+ locationIcon +'" ></span> '+ locationName +' </div></div>'+
            '<div class="status">'+ locationStatus +'</div>'+
            '</div>'+
            '</div>'+
            '</div>')};


            var locations=[
                @foreach($mainCategory as $cateKey => $category)
                    @if(!empty($category['mapCompany']))
                        [locationData('{{ asset("uploads/categories/".$category['image']) }}', '5', '{{++$cateKey}}', '{{ route('site.companyDetails',['slug' => $category['mapCompany']['slug']]) }}', "{{$category['mapCompany']['full_name']}}", '{{$category['mapCompany']['social']['one_phone']}} ', '{{$category['mapCompany']['mainCities']['name'][$currentLang]}}', 'sky', 'flaticon-tent', '{{ $category['title'][$currentLang] }}', 'Now Closed', ), {{$category['mapCompany']['data']['lat']}}, {{$category['mapCompany']['data']['lng']}}, {{++$cateKey}}, '<i class="icon flaticon-find-location"></i>'],
                   @endif
                @endforeach
             ];


            function numericalRating(ratingElem) {
                $(ratingElem).each(function() {
                    var dataRating = $(this).attr('data-rating');
                    if (dataRating >= 4.0) {
                        $(this).addClass('high');
                    } else if (dataRating >= 3.0) {
                        $(this).addClass('mid');
                    } else if (dataRating < 3.0) {
                        $(this).addClass('low');
                    }
                });
            }
            numericalRating('.numerical-rating');


            function starRating(ratingElem) {
                $(ratingElem).each(function() {
                    var dataRating = $(this).attr('data-rating');

                    function starsOutput(firstStar, secondStar, thirdStar, fourthStar, fifthStar) {
                        return ('' +
                            '<span class="' + firstStar + '"></span>' +
                            '<span class="' + secondStar + '"></span>' +
                            '<span class="' + thirdStar + '"></span>' +
                            '<span class="' + fourthStar + '"></span>' +
                            '<span class="' + fifthStar + '"></span>');
                    }
                    var fiveStars = starsOutput('star', 'star', 'star', 'star', 'star');
                    var fourHalfStars = starsOutput('star', 'star', 'star', 'star', 'star half');
                    var fourStars = starsOutput('star', 'star', 'star', 'star', 'star empty');
                    var threeHalfStars = starsOutput('star', 'star', 'star', 'star half', 'star empty');
                    var threeStars = starsOutput('star', 'star', 'star', 'star empty', 'star empty');
                    var twoHalfStars = starsOutput('star', 'star', 'star half', 'star empty', 'star empty');
                    var twoStars = starsOutput('star', 'star', 'star empty', 'star empty', 'star empty');
                    var oneHalfStar = starsOutput('star', 'star half', 'star empty', 'star empty', 'star empty');
                    var oneStar = starsOutput('star', 'star empty', 'star empty', 'star empty', 'star empty');
                    if (dataRating >= 4.75) {
                        $(this).append(fiveStars);
                    } else if (dataRating >= 4.25) {
                        $(this).append(fourHalfStars);
                    } else if (dataRating >= 3.75) {
                        $(this).append(fourStars);
                    } else if (dataRating >= 3.25) {
                        $(this).append(threeHalfStars);
                    } else if (dataRating >= 2.75) {
                        $(this).append(threeStars);
                    } else if (dataRating >= 2.25) {
                        $(this).append(twoHalfStars);
                    } else if (dataRating >= 1.75) {
                        $(this).append(twoStars);
                    } else if (dataRating >= 1.25) {
                        $(this).append(oneHalfStar);
                    } else if (dataRating < 1.25) {
                        $(this).append(oneStar);
                    }
                });
            }
            starRating('.star-rating');

            google.maps.event.addListener(ib,'domready',function(){if(infoBox_ratingType='numerical-rating'){numericalRating('.infoBox .'+infoBox_ratingType+'');}
                if(infoBox_ratingType='star-rating'){starRating('.infoBox .'+infoBox_ratingType+'');}});var mapZoomAttr=$('#map').attr('data-map-zoom');var mapScrollAttr=$('#map').attr('data-map-scroll');if(typeof mapZoomAttr!==typeof undefined&&mapZoomAttr!==false){var zoomLevel=parseInt(mapZoomAttr);}else{var zoomLevel=5;}
            if(typeof mapScrollAttr!==typeof undefined&&mapScrollAttr!==false){var scrollEnabled=parseInt(mapScrollAttr);}else{var scrollEnabled=false;}
            var map=new google.maps.Map(document.getElementById('map'),{zoom:zoomLevel,scrollwheel:scrollEnabled,center:new google.maps.LatLng(40.80,-73.70),mapTypeId:google.maps.MapTypeId.ROADMAP,zoomControl:false,mapTypeControl:false,scaleControl:false,panControl:false,navigationControl:false,streetViewControl:false,gestureHandling:'cooperative',styles:[
                    {
                        "featureType": "water",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#e9e9e9"
                            },
                            {
                                "lightness": 17
                            }
                        ]
                    },
                    {
                        "featureType": "landscape",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#f5f5f5"
                            },
                            {
                                "lightness": 20
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "color": "#ffffff"
                            },
                            {
                                "lightness": 17
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "geometry.stroke",
                        "stylers": [
                            {
                                "color": "#ffffff"
                            },
                            {
                                "lightness": 29
                            },
                            {
                                "weight": 0.2
                            }
                        ]
                    },
                    {
                        "featureType": "road.arterial",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#ffffff"
                            },
                            {
                                "lightness": 18
                            }
                        ]
                    },
                    {
                        "featureType": "road.local",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#ffffff"
                            },
                            {
                                "lightness": 16
                            }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#f5f5f5"
                            },
                            {
                                "lightness": 21
                            }
                        ]
                    },
                    {
                        "featureType": "poi.park",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#dedede"
                            },
                            {
                                "lightness": 21
                            }
                        ]
                    },
                    {
                        "elementType": "labels.text.stroke",
                        "stylers": [
                            {
                                "visibility": "on"
                            },
                            {
                                "color": "#ffffff"
                            },
                            {
                                "lightness": 16
                            }
                        ]
                    },
                    {
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "saturation": 36
                            },
                            {
                                "color": "#333333"
                            },
                            {
                                "lightness": 40
                            }
                        ]
                    },
                    {
                        "elementType": "labels.icon",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "transit",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#f2f2f2"
                            },
                            {
                                "lightness": 19
                            }
                        ]
                    },
                    {
                        "featureType": "administrative",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "color": "#fefefe"
                            },
                            {
                                "lightness": 20
                            }
                        ]
                    },
                    {
                        "featureType": "administrative",
                        "elementType": "geometry.stroke",
                        "stylers": [
                            {
                                "color": "#fefefe"
                            },
                            {
                                "lightness": 17
                            },
                            {
                                "weight": 1.2
                            }
                        ]
                    }
                ]});$('.listing-item-container').on('mouseover',function(){var listingAttr=$(this).data('marker-id');if(listingAttr!==undefined){var listing_id=$(this).data('marker-id')-1;var marker_div=allMarkers[listing_id].div;$(marker_div).addClass('clicked');$(this).on('mouseout',function(){if($(marker_div).is(":not(.infoBox-opened)")){$(marker_div).removeClass('clicked');}});}});var boxText=document.createElement("div");boxText.className='map-box'
            var currentInfobox;var boxOptions={content:boxText,disableAutoPan:false,alignBottom:true,maxWidth:0,pixelOffset:new google.maps.Size(-134,-55),zIndex:null,boxStyle:{width:"320px"},closeBoxMargin:"0",closeBoxURL:"",infoBoxClearance:new google.maps.Size(25,25),isHidden:false,pane:"floatPane",enableEventPropagation:false,};var markerCluster,overlay,i;var allMarkers=[];var clusterStyles=[{textColor:'white',url:'',height:50,width:50}];var markerIco;for(i=0;i<locations.length;i++){markerIco=locations[i][4];var overlaypositions=new google.maps.LatLng(locations[i][1],locations[i][2]),overlay=new CustomMarker(overlaypositions,map,{marker_id:i},markerIco);allMarkers.push(overlay);google.maps.event.addDomListener(overlay,'click',(function(overlay,i){return function(){ib.setOptions(boxOptions);boxText.innerHTML=locations[i][0];ib.close();ib.open(map,overlay);currentInfobox=locations[i][3];google.maps.event.addListener(ib,'domready',function(){$('.infoBox-close').on('click',function(e){e.preventDefault();ib.close();$('.map-marker-container').removeClass('clicked infoBox-opened');});});}})(overlay,i));}
            var options={imagePath:'images/',styles:clusterStyles,minClusterSize:2};markerCluster=new MarkerClusterer(map,allMarkers,options);google.maps.event.addDomListener(window,"resize",function(){var center=map.getCenter();google.maps.event.trigger(map,"resize");map.setCenter(center);});var zoomControlDiv=document.createElement('div');var zoomControl=new ZoomControl(zoomControlDiv,map);function ZoomControl(controlDiv,map){zoomControlDiv.index=1;map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(zoomControlDiv);controlDiv.style.padding='5px';controlDiv.className="zoomControlWrapper";var controlWrapper=document.createElement('div');controlDiv.appendChild(controlWrapper);var zoomInButton=document.createElement('div');zoomInButton.className="custom-zoom-in";controlWrapper.appendChild(zoomInButton);var zoomOutButton=document.createElement('div');zoomOutButton.className="custom-zoom-out";controlWrapper.appendChild(zoomOutButton);google.maps.event.addDomListener(zoomInButton,'click',function(){map.setZoom(map.getZoom()+1);});google.maps.event.addDomListener(zoomOutButton,'click',function(){map.setZoom(map.getZoom()-1);});}
            var scrollEnabling=$('#scrollEnabling');$(scrollEnabling).on('click',function(e){e.preventDefault();$(this).toggleClass("enabled");if($(this).is(".enabled")){map.setOptions({'scrollwheel':true});}else{map.setOptions({'scrollwheel':false});}})
            $("#geoLocation, .input-with-icon.location a").on('click',function(e){e.preventDefault();geolocate();});

            function geolocate(){if(navigator.geolocation){navigator.geolocation.getCurrentPosition(function(position){var pos=new google.maps.LatLng(position.coords.latitude,position.coords.longitude);map.setCenter(pos);map.setZoom(12);});}}}
            var map=document.getElementById('map');if(typeof(map)!='undefined'&&map!=null){google.maps.event.addDomListener(window,'load',mainMap);}

            function singleListingMap() {
                var myLatlng=new google.maps.LatLng( {
                        lng: $('#singleListingMap').data('longitude'), lat: $('#singleListingMap').data('latitude'),
                    }
                );
                var single_map=new google.maps.Map(document.getElementById('singleListingMap'), {
                        zoom:15, center:myLatlng, scrollwheel:false, zoomControl:false, mapTypeControl:false, scaleControl:false, panControl:false, navigationControl:false, streetViewControl:false, styles:[
                            {
                                "featureType": "water",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "color": "#e9e9e9"
                                    },
                                    {
                                        "lightness": 17
                                    }
                                ]
                            },
                            {
                                "featureType": "landscape",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "color": "#f5f5f5"
                                    },
                                    {
                                        "lightness": 20
                                    }
                                ]
                            },
                            {
                                "featureType": "road.highway",
                                "elementType": "geometry.fill",
                                "stylers": [
                                    {
                                        "color": "#ffffff"
                                    },
                                    {
                                        "lightness": 17
                                    }
                                ]
                            },
                            {
                                "featureType": "road.highway",
                                "elementType": "geometry.stroke",
                                "stylers": [
                                    {
                                        "color": "#ffffff"
                                    },
                                    {
                                        "lightness": 29
                                    },
                                    {
                                        "weight": 0.2
                                    }
                                ]
                            },
                            {
                                "featureType": "road.arterial",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "color": "#ffffff"
                                    },
                                    {
                                        "lightness": 18
                                    }
                                ]
                            },
                            {
                                "featureType": "road.local",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "color": "#ffffff"
                                    },
                                    {
                                        "lightness": 16
                                    }
                                ]
                            },
                            {
                                "featureType": "poi",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "color": "#f5f5f5"
                                    },
                                    {
                                        "lightness": 21
                                    }
                                ]
                            },
                            {
                                "featureType": "poi.park",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "color": "#dedede"
                                    },
                                    {
                                        "lightness": 21
                                    }
                                ]
                            },
                            {
                                "elementType": "labels.text.stroke",
                                "stylers": [
                                    {
                                        "visibility": "on"
                                    },
                                    {
                                        "color": "#ffffff"
                                    },
                                    {
                                        "lightness": 16
                                    }
                                ]
                            },
                            {
                                "elementType": "labels.text.fill",
                                "stylers": [
                                    {
                                        "saturation": 36
                                    },
                                    {
                                        "color": "#333333"
                                    },
                                    {
                                        "lightness": 40
                                    }
                                ]
                            },
                            {
                                "elementType": "labels.icon",
                                "stylers": [
                                    {
                                        "visibility": "off"
                                    }
                                ]
                            },
                            {
                                "featureType": "transit",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "color": "#f2f2f2"
                                    },
                                    {
                                        "lightness": 19
                                    }
                                ]
                            },
                            {
                                "featureType": "administrative",
                                "elementType": "geometry.fill",
                                "stylers": [
                                    {
                                        "color": "#fefefe"
                                    },
                                    {
                                        "lightness": 20
                                    }
                                ]
                            },
                            {
                                "featureType": "administrative",
                                "elementType": "geometry.stroke",
                                "stylers": [
                                    {
                                        "color": "#fefefe"
                                    },
                                    {
                                        "lightness": 17
                                    },
                                    {
                                        "weight": 1.2
                                    }
                                ]
                            }
                        ]

                    }
                );
                $('#streetView').on('click',function(e) {
                        e.preventDefault();
                        single_map.getStreetView().setOptions( {
                                visible: true, position: myLatlng
                            }
                        );
                    }
                );
                var zoomControlDiv=document.createElement('div');
                var zoomControl=new ZoomControl(zoomControlDiv, single_map);
                function ZoomControl(controlDiv, single_map) {
                    zoomControlDiv.index=1;
                    single_map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(zoomControlDiv);
                    controlDiv.style.padding='5px';
                    var controlWrapper=document.createElement('div');
                    controlDiv.appendChild(controlWrapper);
                    var zoomInButton=document.createElement('div');
                    zoomInButton.className="custom-zoom-in";
                    controlWrapper.appendChild(zoomInButton);
                    var zoomOutButton=document.createElement('div');
                    zoomOutButton.className="custom-zoom-out";
                    controlWrapper.appendChild(zoomOutButton);
                    google.maps.event.addDomListener(zoomInButton, 'click', function() {
                            single_map.setZoom(single_map.getZoom()+1);
                        }
                    );
                    google.maps.event.addDomListener(zoomOutButton, 'click', function() {
                            single_map.setZoom(single_map.getZoom()-1);
                        }
                    );
                }
                var singleMapIco="<i class='"+$('#singleListingMap').data('map-icon')+"'></i>";
                new CustomMarker(myLatlng, single_map, {
                        marker_id: '1'
                    }
                    , singleMapIco);
            }

            var single_map=document.getElementById('singleListingMap');
            if(typeof(single_map)!='undefined'&&single_map!=null) {
                google.maps.event.addDomListener(window, 'load', singleListingMap);
            }





            function CustomMarker(latlng,map,args,markerIco){this.latlng=latlng;this.args=args;this.markerIco=markerIco;this.setMap(map);}
            CustomMarker.prototype=new google.maps.OverlayView();CustomMarker.prototype.draw=function(){var self=this;var div=this.div;if(!div){div=this.div=document.createElement('div');div.className='map-marker-container';div.innerHTML='<div class="marker-container">'+
                '<div class="marker-card">'+
                '<div class="front face">'+self.markerIco+'</div>'+
                '<div class="back face">'+self.markerIco+'</div>'+
                '<div class="marker-arrow"></div>'+
                '</div>'+
                '</div>'
                google.maps.event.addDomListener(div,"click",function(event){$('.map-marker-container').removeClass('clicked infoBox-opened');google.maps.event.trigger(self,"click");$(this).addClass('clicked infoBox-opened');});if(typeof(self.args.marker_id)!=='undefined'){div.dataset.marker_id=self.args.marker_id;}
                var panes=this.getPanes();panes.overlayImage.appendChild(div);}
                var point=this.getProjection().fromLatLngToDivPixel(this.latlng);if(point){div.style.left=(point.x)+'px';div.style.top=(point.y)+'px';}};CustomMarker.prototype.remove=function(){if(this.div){this.div.parentNode.removeChild(this.div);this.div=null;$(this).removeClass('clicked');}};CustomMarker.prototype.getPosition=function(){return this.latlng;};})(this.jQuery);

    </script>
    @if(!empty(auth('user')->user()->id))
        <script>
            $(document).on('click', '.like-btn', function (e) {
                e.preventDefault();

                const $btn = $(this);
                const itemId = $btn.data('item-id');
                const itemType = $btn.data('item-type');
                const isLiked = $btn.data('liked');

                const url = !isLiked ? '{{ route('site.user.like') }}' : '{{ route('site.user.unlike') }}';

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        item_id: itemId,
                        item_type: itemType,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.success) {
                            // toggle class
                            $btn.find('span').toggleClass('active');
                            // update data-liked value
                            $btn.data('liked', !isLiked);
                        }
                    },
                    error: function (xhr) {
                        alert('Əməliyyatda xəta baş verdi.');
                    }
                });
            });

        </script>
    @endif
@endsection
