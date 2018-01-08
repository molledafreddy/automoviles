<template>
    <div class="container">            
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h3>Tu perfil</h3>
                    </div>
                    <div class="pull-right">
                         <button class="btn btn-success btn-xs" @click="showModalImport = true">Carga de archivo</button>
                        <button class="btn btn-success btn-xs" @click="showModal = true">Nueva imagen</button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <form method="POST"  @save="save">
                    <div class="panel-body row">
                    <div  class="col-sm-6">
                        <h3 slot="header">Tus datos</h3>
                        <div slot="body">
                            <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="">DNI</label>
                                    <input type="text" name="name" class="form-control" v-model="user.name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Nombre</label>
                                    <input type="text" class="form-control" v-model="user.name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Fecha de nacimiento</label>
                                    <input type="date" class="form-control" v-model="user.birthdate">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Correo</label>
                                    <input type="email" class="form-control" v-model="user.email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Modelo del carro</label>
                                    <input type="text" class="form-control" v-model="user.car_model">
                                </div>                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Año del carro</label>
                                    <input type="text" class="form-control" v-model="user.car_year">
                                </div>                                
                            </div>
                        </div>                                                                   
                    </div>    
                    </div>
                </form>
                <div class="panel-body row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>DNI</th>
                                <th>Nombre</th>
                                <th>Nacionalidad</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Teléfono</th>
                                <th>Salario</th>
                                <th>N° Cuenta</th>
                                <th>Banco</th>
                                <th>Empresa</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(user, index) in users">
                                <td>{{user.dni}}</td>                   
                                <td>{{user.name}}</td>
                                <td>{{user.nacionality}}</td>
                                <td>{{user.email}}</td>
                                <td>{{user.role}}</td>
                                <td>{{ user.customer_user != null ? user.customer_user.phone : ''}}</td>
                                <td>{{ user.customer_user != null ? user.customer_user.monthly_salary : ''}}</td>
                                <td>{{ user.customer_user != null ? user.customer_user.acconunt_number : ''}}</td> 
                                <td>{{ user.banks.length > 0 ? user.banks[0].name : '' }}</td>
                                <td>{{ user.customers.length > 0 ? user.customers[0].name : ''}}</td>
                                <td>
                                    <button class="btn btn-primary btn-xs" @click="edit(index)">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn-danger btn-xs" @click="destroy(user.id)">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <modal v-if="showModal" @close="showModal = false" @save="save">
                        <h3 slot="header">Cargar imagen</h3>
                        <div slot="body">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">description</label>
                                    <input type="text" class="form-control" v-model="draft.description">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="btn btn-default btn-primary form-control">
                               <b>Seleccione la imagen</b> <input class="form-control btn-xs" type="file" style="display: none;" @change="loadfile">
                            </label>
                                </div>
                            </div>                            
                        </div>    
                    </modal>
                   </div>                   
            </div>    
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return{
                editing: false, // editar un empleado
                showModal: false, // crear un empleado
                draft: {},
                currentIndex: null,
                currentId: null,
                user: [],
                message: '',  
            }
        },
        mounted() {
            //this.getUsers(1);
            this.getUser();
        },
        methods:{
            /*
            getUser(page){
                var self = this;
                axios.get('/api/v1/user?page=' + page)
                    .then(response => {
                        console.log(response);
                        self.users = response.data.users.data;
                        self.banks = response.data.banks;
                        self.customers = response.data.customers;
                    })
                    .catch(error => {
                        alert(error.data.message);
                    })
            },
            getUser($id){
                var self = this;
                        console.log("hola");
                axios.get('/user' + $id)
                    .then(response => {
                        self.user = response.data.user.data;
                        alert(response.data.message);
                                           })
                    .catch(error => {
                        //alert(error.data.message);
                    })
            },
            */
           getUser(page){
                var self = this;
                //axios.get('/user')
                axios.get('/api/v1/user?='+ page)
                    .then(function(response) {
                        console.log(response);
                        self.user = response.data.user;
                        //alert(response.data.user.data);
                        //self.user = response.data.message;
                    })
                    .catch(error => {
                        //alert(error.data.message);
                    })
            },
            save(){
                    this.update();
                    this.showModal = false;
            },            
            // end cargado el archivo de empleados
            store(){
                var self = this;
                axios.post('/api/v1/user', this.draft)
                    .then(response => {                        
                        self.users.push(self.draft);
                        self.draft = {};                        
                        alert(response.data.message);
                    })
                    .catch(error => {
                        console.log(error);
                    })                
            },
            update(){
                var self = this;
                axios.put('/api/v1/user/' + this.currentId, this.draft)
                    .then( function(response){                        
                        self.users[self.currentIndex] = self.draft;
                        self.draft = {};  
                        alert(response.data.message);
                        self.getUsers();
                    })
                    .catch(error => {
                        alert(error.data.message);
                    })                  
            },
            edit(index){
                this.draft = Object.assign({}, this.users[index]);
                this.draft.phone = this.users[index].customer_user.phone;
                this.draft.acconunt_number = this.users[index].customer_user.acconunt_number;
                this.draft.monthly_salary = this.users[index].customer_user.monthly_salary;
                this.draft.customer_id = this.users[index].customers[0].id;
                this.draft.bank_id = this.users[index].banks[0].id; 
                this.currentIndex = index;
                this.currentId = this.users[index].id;
                this.showModal = true;
                this.editing = true;
            },

            destroy(id){
               var self = this;
                axios.get('/api/v1/user/delete?id=' + id)
                    .then(function(response) {
                        console.log(response);
                        alert(response.data.message);
                        self.getUsers();
                    })
                    .catch(error => {
                        alert(error.data.message);
                    }) 
            },
        }
    }
</script>