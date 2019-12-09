<template>

<div class="col-8 col-sm-8 col-md-8 col-lg-8" >
  <form @submit="checkForm" action="" >
    <div class="d-flex align-items-start">
    <h2>Adicionar um Paciente</h2>
</div>
<p v-if="errors.length">
    <b>Por favor, corrija o(s) seguinte(s) erro(s):</b>
    <ul class="alert alert-danger">
      <li  v-for="error in errors" v-bind:key="error.error" >{{ error }} </li>
    </ul>
  </p>

            <div class="form-group">
              <h6>Nome do Paciente</h6>
                <input type="text" class="form-control" placeholder="Nome" v-model="paciente.nome">
            </div>
             <div class="form-group">
                           <h6>Sexo do Paciente</h6>

                        <select class="form-control" id="exampleFormControlSelect1" v-model="paciente.sexo">
                            <option>masculino</option>
                             <option>feminino</option>
                       
                        </select>
                         
            </div> 
            <div class="form-group">
              <h6>Idade do Paciente</h6>
                <input type="number" class="form-control" placeholder="Idade" v-model="paciente.idade">
            </div>
            <div class="form-group">
                <h6>Email do Paciente</h6>
                <input type="email" class="form-control" placeholder="Email" v-model="paciente.email">
            </div>
                <button type="submit" class="btn btn-success btn-block">Salvar</button>
            </form>

<div class="table-responsive card-body  ">
      <h3>Pacientes</h3>

    <table class=" table table-striped table-bordered table-ligth bg-white "  >
    <thead>
    <tr>
      <th >Nome</th>
      <th >Sexo</th>
      <th >idade</th>
      <th>E-mail</th>
      <th>Açoes</th>
    </tr>
  </thead>
  <tbody>
    <tr  class="table-active" v-for="paciente in pacientes" v-bind:key="paciente.id">
      <th >{{paciente.nome}}</th>
      <td>{{paciente.sexo}}</td>
      <td>{{paciente.idade}}</td>
      <td>{{paciente.email}}</td>
      <td><button @click="deletePaciente(paciente.id)" class="btn btn-danger mb-2"> Deletar</button>
      <td><button @click="editPaciente(paciente)" class="btn btn-warning mb-2"> Atualizar</button>

</td>
    </tr>
  <ul class="pagination">
    <li v-bind:class="[{disabled:!pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#"
    @click="fetchPacientes(pagination.prev_page_url)"
    >Previous</a></li>
    <li class="page-item disabled"><a class="page-link text-dark" href="#">Pagina {{pagination.current_page}} de {{pagination.last_page}}</a></li>

    <li v-bind:class="[{disabled:!pagination.next_page_url}]" class="page-item"><a class="page-link" href="#"
    @click="fetchPacientes(pagination.next_page_url)"
    >Next</a></li>
  </ul>
  </tbody>
    </table>
    </div>
  
    </div>

</template>
<script>
export default {
    data(){
        return{
            pacientes:[],
            paciente:{
                id:'',
                nome:'',
                sexo:'',
                idade:'',
                email:''
           
           },
           options: [
                { text: 'Masculino', value: 'masculino' },
                { text: 'Feminino', value: 'feminino' }
             ],
                 errors: [],

            paciente_id:'',
            pagination:{},
            edit:false,

        }
        
    },
    created(){
        this.fetchPacientes();
    },
    methods:{
        fetchPacientes(page_url){
            let vm = this;
            page_url = page_url || '/api/paciente'
            fetch(page_url)
            .then(res=>res.json())
            .then(res=>{
                this.pacientes = res.data;
                vm.makePagination(res.meta,res.links);
            })
            .catch(err =>console.log(err));
        },
        makePagination(meta,links){
            let pagination = {
               current_page:meta.current_page,
               last_page:meta.last_page,
               next_page_url:links.next,
               prev_page_url:links.prev

            }
            this.pagination = pagination;
         },
      deletePaciente(id){
          if (confirm('Tem certeza que quer exclir esse Paciente')) {
                 fetch(`/api/paciente/${id}`,{
                     method:'delete'
                 })
                 .then(res =>res.json())
               .then(data =>{
                    alert('Paciente removido');
                   this.fetchPacientes();
               })
               .catch(err=>console.log(err));
            }
         },
         addPaciente(){
             if(this.edit===false){
                //add 
               fetch('/api/paciente',{
                method:'post',
               body:JSON.stringify(this.paciente),
                headers :{
                    'content-type':'application/json',
                    'Accept': 'application/json'
                }
               })
                .then(res =>res.json())
                .then(data=> {
                   this.paciente.nome= '';
                   this.paciente.sexo= '';
                   this.paciente.idade='';
                   this.paciente.email='';
                   alert('Registro inserido');
                   this.fetchPacientes();
               })
             }else{
                //edit
                if (confirm('Tem certeza que quer atualizar esse registro')) {
                     fetch('/api/paciente',{
                method:'put',
                body:JSON.stringify(this.paciente),
                headers :{
                     'content-type':'application/json',
                     'Accept': 'application/json'

            }
                })
                .then(res =>res.json())
               .then(data=> {
                   this.paciente.nome= '';
                   this.paciente.sexo= '';
                   this.paciente.idade='';
                   this.paciente.email='';
                   alert('Registro atualizado');
                this.fetchPacientes();
                this.edit = false;
                  this.paciente.id='';
              })
                 }
                 
                
             }
         },
         editPaciente(paciente){
             this.edit =true;
             this.paciente.id =paciente.id;
             this.paciente.paciente_id = paciente.id;
             this.paciente.nome= paciente.nome;
             this.paciente.sexo= paciente.sexo;

             this.paciente.idade=paciente.idade;

             this.paciente.email=paciente.email;

         },checkForm: function (e) {
      if ( this.paciente.nome && this.paciente.sexo && this.paciente.idade && this.paciente.email) {
        this.addPaciente();
      }

      this.errors = [];

      if (!this.paciente.nome) {
        this.errors.push('O nome é obrigatório.');
      }
      if (!this.paciente.sexo) {
        this.errors.push('O sexo é obrigatório.');
      }
      if (!this.paciente.idade) {
        this.errors.push('A idade é obrigatória.');
      }
        if (!this.paciente.email) {
        this.errors.push('O email é obrigatório.');
      }

      e.preventDefault();
    }


    }

}
</script>
