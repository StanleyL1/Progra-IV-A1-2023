Vue.component('component-inscritos',{
    data() {
        return {
            accion:'nuevo',
            buscar: '',
            inscritos: [],
            inscrito:{
                idInscrito : '',
                codigo : '',
                nombre : '',
                
            }
        }
    },
    methods:{
        guardarInscrito(){
            
            let store = this.abrirStore('tblinscritos', 'readwrite');
            if(this.accion==='nuevo'){
                this.inscrito.idInscrito = new Date().getTime().toString(16);
            }
            store.put( JSON.parse(JSON.stringify(this.inscrito) ) );
            this.listarInscritos();
            this.nuevoInscrito();
        },
        eliminarInscrito(inscrito){
            if( confirm(`Esta seguro de eliminar a ${inscrito.nombre}?`) ){
                let store = this.abrirStore('tblinscritos', 'readwrite'),
                    req = store.delete(inscrito.idInscrito);
                req.onsuccess = resp=>{
                    this.listarInscritos();
                };
            }
        },
        nuevoInscrito(){
            this.accion = 'nuevo';
            this.inscrito.idInscrito = '';
            this.inscrito.codigo = '';
            this.inscrito.nombre = '';
            
        },
        modificarInscrito(inscrito){
            this.accion = 'modificar';
            this.inscrito = inscrito;
        },
        listarInscritos(){
            let store = this.abrirStore('tblinscritos', 'readonly'),
                data = store.getAll();
            data.onsuccess = resp=>{
                this.inscritos = data.result
                .filter(inscrito=>inscrito.nombre.toLowerCase().indexOf(this.buscar.toLowerCase())>-1||
                inscrito.codigo.indexOf(this.buscar)>-1 ||
                inscrito.nombre.indexOf(this.buscar)>-1
              );
            };
        },
        abrirStore(store, modo){
            let tx = this.db.transaction(store, modo); 
            return tx.objectStore(store);
        },
        abrirBD(){
            let indexDB = indexedDB.open('InscritosDB',1);
            indexDB.onupgradeneeded=e=>{
                let req = e.target.result,
                    tblinscrito = req.createObjectStore('tblinscritos', {keyPath:'idInscrito'});
                    

                tblinscrito.createIndex('idInscrito', 'idInscrito', {unique:true});
                
            };
            indexDB.onsuccess= e=>{
                this.db = e.target.result;
                this.listarInscritos();
            };
            indexDB.onerror= e=>{
                console.error( e );
            };
        },
    },
    created(){
        this.abrirBD();
    },
    template: `
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">ALUMNOS INSCRITOS</div>
                    <div class="card-body">
                        <form id="frmInscrito" @reset.prevent="nuevoInscrito" v-on:submit.prevent="guardarInscrito">
                            <div class="row p-1">
                                <div class="col-3 col-md-2">
                                    <label for="txtCodigoInscrito">CODIGO:</label>
                                </div>
                                <div class="col-3 col-md-3">
                                    <input required pattern="[0-9]{3}" 
                                        title="Ingrese un codigo de inscrito de 3 digitos"
                                            v-model="inscrito.codigo" type="text" class="form-control" name="txtCodigoInscrito" id="txtCodigoInscrito">
                                </div>
                            </div>
                            <div class="row p-1">
                                <div class="col-3 col-md-2">
                                    <label for="txtNombreInscrito">NOMBRE:</label>
                                </div>
                                <div class="col-9 col-md-6">
                                    <input required pattern="[A-Za-zÑñáéíóú ]{3,75}"
                                        v-model="inscrito.nombre" type="text" class="form-control" name="txtNombreInscrito" id="txtNombreInscrito">
                                </div>
                            </div>

                          
                            <div class="row p-1">
                                <div class="col-3 col-md-3">
                                    <input class="btn btn-primary" type="submit" 
                                        value="Guardar">
                                </div>
                                <div class="col-3 col-md-3">
                                    <input class="btn btn-warning" type="reset" value="Nuevo">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">LISTADO DE INSCRITOSS</div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>BUSCAR:</th>
                                    <th colspan="2"><input type="text" class="form-control" v-model="buscar"
                                        @keyup="listarInscritos()"
                                        placeholder="Buscar por codigo o nombre"></th>
                                </tr>
                                <tr>
                                    <th>CODIGO</th>
                                    <th>NOMBRE</th>
                                

                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="inscrito in inscritos" :key="inscrito.idInscrito" @click="modificarInscrito(inscrito)" >
                                    <td>{{ inscrito.codigo }}</td>
                                    <td>{{ inscrito.nombre }}</td>
                                    
                                    <td><button class="btn btn-danger" @click="eliminarInscrito(inscrito)">ELIMINAR</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    `
});