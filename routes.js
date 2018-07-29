var routes = ($stateProvider, $urlRouterProvider) => {
  
  $stateProvider
  .state('principal', {
    url: "/",
    templateUrl: "partials/principal.html"      
  })
  
  $stateProvider
    .state('siniestrosOnline', {
      url: "/",
      templateUrl: "partials/siniestrosOnline.html",
      controller: "contactoController as ContactoController"
      
    })


    .state('newSiniestros', {
      url: "/",
      templateUrl: "partials/newSiniestros.html"
        })

  $urlRouterProvider.otherwise("/")

}