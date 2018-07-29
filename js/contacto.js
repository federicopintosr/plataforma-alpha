class Contacto {
    
        constructor(_nombre,_telefono,_mail) {
    
            this.nombre = _nombre
            this.telefono = _telefono
            this.mail = _mail
            this.fav = false
    
        }
    
        cambiarDeEstado() {
    
            if (this.fav) {
                this.fav = false
            } else this.fav = true
        }
    
    
    }