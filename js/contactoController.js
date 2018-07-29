class ContactoController {
    constructor() {
        
        this.contactos=[new Contacto("Walter White","151234554","heisenber@gmail.com"),new Contacto("John Snow","1534250055","elreydelnorte@hotmail.com"),new Contacto("Carlitox","156876441","soyCarlitox@hotmail.com")]
        this.contactoAEditar 

        //nuevo :
        this.nuevoNombre
        this.nuevoTelefono
        this.nuevoMail
  }


  seleccionarContacto(_contacto){
      this.contactoAEditar = _contacto
  }

  agregarContacto(){
      this.contactos.push(this.crearContacto())
  }

  crearContacto(){
      return new Contacto(this.nuevoNombre,this.nuevoTelefono,this.nuevoMail)
  }

  editarContacto(){
    this.contactoAEditar.nombre = this.nuevoNombre
    this.contactoAEditar.mail = this.nuevoMail
    this.contactoAEditar.telefono = this.nuevoTelefono
  }


}