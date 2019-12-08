<template>

<div class="col-8 col-sm-8 col-md-8 col-lg-8" >
  <form @submit="checkForm" action="" >
    <div class="d-flex align-items-start">
    <h2>Adicionar um clinica</h2>
</div>
<p v-if="errors.length">
    <b>Por favor, corrija o(s) seguinte(s) erro(s):</b>
    <ul class="alert alert-danger">
      <li  v-for="error in errors" v-bind:key="error.error" >{{ error }} </li>
    </ul>
  </p>

            <div class="form-group">
              <h6>Nome do clinica</h6>
                <input type="text" class="form-control" placeholder="Nome" v-model="clinica.nome">
            </div>
             <div class="form-group">
                           <h6>CNES do clinica</h6>    
            <input type="number" class="form-control" placeholder="CNES" v-model="clinica.cnes">
            </div> 
            <div class="form-group">
              <h6>Proprietario do clinica</h6>
                <input type="text" class="form-control" placeholder="Proprietario" v-model="clinica.proprietario">
            </div>
            <div class="form-group">
                <h6>CNPJ do clinica</h6>
                <input type="number" class="form-control" placeholder="CNPJ" v-model="clinica.cnpj">
            </div>
                <button type="submit" class="btn btn-success btn-block">Salvar</button>
            </form>

<div class="table-responsive card-body  ">
      <h3>clinicas</h3>

    <table class=" table table-striped table-bordered table-ligth bg-white "  >
    <thead>
    <tr>
      <th >Nome</th>
      <th >CNES</th>
      <th >Proprietario</th>
      <th>CNPJ</th>
      <th>Açoes</th>
    </tr>
  </thead>
  <tbody>
    <tr  class="table-active" v-for="clinica in clinicas" v-bind:key="clinica.id">
      <th >{{clinica.nome}}</th>
      <td>{{clinica.cnes}}</td>
      <td>{{clinica.proprietario}}</td>
      <td>{{clinica.cnpj}}</td>
      <td><button @click="deleteClinica(clinica.id)" class="btn btn-danger mb-2"> Deletar</button>
      <td><button @click="editClinica(clinica)" class="btn btn-warning mb-2"> Atualizar</button>

</td>
    </tr>
  <ul class="pagination">
    <li v-bind:class="[{disabled:!pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#"
    @click="fetchClinicas(pagination.prev_page_url)"
    >Previous</a></li>
    <li class="page-item disabled"><a class="page-link text-dark" href="#">Pagina {{pagination.current_page}} de {{pagination.last_page}}</a></li>

    <li v-bind:class="[{disabled:!pagination.next_page_url}]" class="page-item"><a class="page-link" href="#"
    @click="fetchClinicas(pagination.next_page_url)"
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
            clinicas:[],
            clinica:{
                id:'',
                nome:'',
                cnes:'',
                proprietario:'',
                cnpj:'',
           
           },
                 errors: [],

            clinica_id:'',
            pagination:{},
            edit:false,

        }
        
    },
    created(){
        this.fetchClinicas();
    },
    methods:{
        fetchClinicas(page_url){
            let vm = this;
            page_url = page_url || '/api/clinica'
            fetch(page_url)
            .then(res=>res.json())
            .then(res=>{
                this.clinicas = res.data;
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
      deleteClinica(id){
          if (confirm('Tem certeza que quer exclir esse clinica')) {
                 fetch(`/api/clinica/${id}`,{
                     method:'delete'
                 })
                 .then(res =>res.json())
               .then(data =>{
                    alert('clinica removido');
                   this.fetchClinicas();
               })
               .catch(err=>console.log(err));
            }
         },
         addClinica(){
             if(this.edit===false){
                //add 
               fetch('/api/clinica',{
                method:'post',
               body:JSON.stringify(this.clinica),
                headers :{
                    'content-type':'application/json',
                    'Accept': 'application/json'
                }
               })
                .then(res =>res.json())
                .then(data=> {
                   this.clinica.nome= '';
                   this.clinica.cnes= '';
                   this.clinica.proprietario='';
                   this.clinica.cnpj='';
                   alert('Clinica Cadastrado ');
                   this.fetchClinicas();
               })
             }else{
                //edit
                if (confirm('Tem certeza que quer atualizar esse registro')) {
                     fetch('/api/clinica',{
                method:'put',
                body:JSON.stringify(this.clinica),
                headers :{
                     'content-type':'application/json',
                     'Accept': 'application/json'

            }
                })
                .then(res =>res.json())
               .then(data=> {
                                    
                   this.clinica.nome= '';
                   this.clinica.cnes= '';
                   this.clinica.proprietario='';
                   this.clinica.cnpj='';
                   
                   alert('Clinica Atualizada ');
                this.fetchClinicas();
                this.edit = false;
                  this.clinica.id='';

              })
                 }
                 
                
             }
         },
         editClinica(clinica){
             this.edit =true;
             this.clinica.id =clinica.id;
             this.clinica.clinica_id = clinica.id;
             this.clinica.nome= clinica.nome;
             this.clinica.cnes= clinica.cnes;

             this.clinica.proprietario=clinica.proprietario;

             this.clinica.cnpj=clinica.cnpj;

         },checkForm: function (e) {
      if ( this.clinica.nome && this.clinica.cnes && this.clinica.proprietario && this.clinica.cnpj) {
        this.addClinica();
      }

      this.errors = [];

      if (!this.clinica.nome) {
        this.errors.push('O nome é obrigatório.');
      }
      if (!this.clinica.cnes) {
        this.errors.push('O cnes é obrigatório.');
      }
      if (!this.clinica.proprietario) {
        this.errors.push('O´nome do proprietario é obrigatório.');
      }
        if (!this.clinica.cnpj) {
        this.errors.push('O cnpj é obrigatório.');
      }

      e.preventDefault();
    }


    }

}
</script>