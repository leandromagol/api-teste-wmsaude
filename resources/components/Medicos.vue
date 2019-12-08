<template>

<div class="col-8 col-sm-8 col-md-8 col-lg-8" >
  <form @submit="checkForm" action="" >
    <div class="d-flex align-items-start">
    <h2>Adicionar um medico</h2>
</div>
<p v-if="errors.length">
    <b>Por favor, corrija o(s) seguinte(s) erro(s):</b>
    <ul class="alert alert-danger">
      <li  v-for="error in errors" v-bind:key="error.error" >{{ error }} </li>
    </ul>
  </p>

            <div class="form-group">
              <h6>Nome do medico</h6>
                <input type="text" class="form-control" placeholder="Nome" v-model="medico.nome">
            </div>
             <div class="form-group">
                           <h6>CRM do medico</h6>    
            <input type="number" class="form-control" placeholder="CRM" v-model="medico.crm">
            </div> 
            <div class="form-group">
              <h6>Email do medico</h6>
                <input type="email" class="form-control" placeholder="Email" v-model="medico.email">
            </div>
            <div class="form-group">
                <h6>Especialidade do medico</h6>
                <input type="text" class="form-control" placeholder="Especialidade" v-model="medico.especialidade">
            </div>
                <button type="submit" class="btn btn-success btn-block">Salvar</button>
            </form>

<div class="table-responsive card-body  ">
      <h3>Medicos</h3>

    <table class=" table table-striped table-bordered table-ligth bg-white "  >
    <thead>
    <tr>
      <th >Nome</th>
      <th >CRM</th>
      <th >E-mail</th>
      <th>Especialidade</th>
      <th>Açoes</th>
    </tr>
  </thead>
  <tbody>
    <tr  class="table-active" v-for="medico in medicos" v-bind:key="medico.id">
      <th >{{medico.nome}}</th>
      <td>{{medico.crm}}</td>
      <td>{{medico.email}}</td>
      <td>{{medico.especialidade}}</td>
      <td><button @click="deleteMedico(medico.id)" class="btn btn-danger mb-2"> Deletar</button>
      <td><button @click="editMedico(medico)" class="btn btn-warning mb-2"> Atualizar</button>

</td>
    </tr>
  <ul class="pagination">
    <li v-bind:class="[{disabled:!pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#"
    @click="fetchMedicos(pagination.prev_page_url)"
    >Previous</a></li>
    <li class="page-item disabled"><a class="page-link text-dark" href="#">Pagina {{pagination.current_page}} de {{pagination.last_page}}</a></li>

    <li v-bind:class="[{disabled:!pagination.next_page_url}]" class="page-item"><a class="page-link" href="#"
    @click="fetchMedicos(pagination.next_page_url)"
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
            medicos:[],
            medico:{
                id:'',
                nome:'',
                crm:'',
                email:'',
                especialidade:'',
           
           },
                 errors: [],

            medico_id:'',
            pagination:{},
            edit:false,

        }
        
    },
    created(){
        this.fetchMedicos();
    },
    methods:{
        fetchMedicos(page_url){
            let vm = this;
            page_url = page_url || '/api/medico'
            fetch(page_url)
            .then(res=>res.json())
            .then(res=>{
                this.medicos = res.data;
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
      deleteMedico(id){
          if (confirm('Tem certeza que quer exclir esse medico')) {
                 fetch(`/api/medico/${id}`,{
                     method:'delete'
                 })
                 .then(res =>res.json())
               .then(data =>{
                    alert('Medico removido');
                   this.fetchMedicos();
               })
               .catch(err=>console.log(err));
            }
         },
         addMedico(){
             if(this.edit===false){
                //add 
               fetch('/api/medico',{
                method:'post',
               body:JSON.stringify(this.medico),
                headers :{
                    'content-type':'application/json',
                    'Accept': 'application/json'
                }
               })
                .then(res =>res.json())
                .then(data=> {
                   this.medico.nome= '';
                   this.medico.crm= '';
                   this.medico.email='';
                   this.medico.especialidade='';
                   alert('Medico Cadastrado ');
                   this.fetchMedicos();
               })
             }else{
                //edit
                if (confirm('Tem certeza que quer atualizar esse registro')) {
                     fetch('/api/medico',{
                method:'put',
                body:JSON.stringify(this.medico),
                headers :{
                     'content-type':'application/json',
                     'Accept': 'application/json'

            }
                })
                .then(res =>res.json())
               .then(data=> {
                    this.medico.nome= '';
                   this.medico.crm= '';
                   this.medico.email='';
                   this.medico.especialidade='';
                   alert('Medico Atualizado ');
                this.fetchMedicos();
                 this.edit = false;
                  this.medico.id='';
              })
                 }
                 
                
             }
         },
         editMedico(medico){
             this.edit =true;
             this.medico.id =medico.id;
             this.medico.medico_id = medico.id;
             this.medico.nome= medico.nome;
             this.medico.crm= medico.crm;

             this.medico.email=medico.email;

             this.medico.especialidade=medico.especialidade;

         },checkForm: function (e) {
      if ( this.medico.nome && this.medico.crm && this.medico.email && this.medico.especialidade) {
        this.addMedico();
      }

      this.errors = [];

      if (!this.medico.nome) {
        this.errors.push('O nome é obrigatório.');
      }
      if (!this.medico.crm) {
        this.errors.push('O crm é obrigatório.');
      }
      if (!this.medico.email) {
        this.errors.push('O email é obrigatório.');
      }
        if (!this.medico.especialidade) {
        this.errors.push('A especialidade é obrigatória.');
      }

      e.preventDefault();
    }


    }

}
</script>