<template>

<div class="col-8 col-sm-8 col-md-8 col-lg-8" >
  <form @submit="checkForm" action="" >
    <div class="d-flex align-items-start">
    <h2>Consultas</h2>
</div>
<p v-if="errors.length">
    <b>Por favor, corrija o(s) seguinte(s) erro(s):</b>
    <ul class="alert alert-danger">
      <li  v-for="error in errors" v-bind:key="error.error" >{{ error }} </li>
    </ul>
  </p>


  



            <div class="form-group">
                <h5>Medico</h5>
                <select  class="form-control" v-model="consulta.id_medico">
                <option  value="">Escolha um item</option>
                <option    v-for="medico in medicos" v-bind:value="medico.id" v-bind:key="medico.id" >
                {{ medico.nome}}- Especialidade: {{ medico.especialidade}}
                 </option>
                </select>            
            </div>
             <div class="form-group">
            <h5>Paciente</h5>
                <select  class="form-control" v-model="consulta.id_paciente">
                <option  value="">Escolha um item</option>
                <option  v-for="paciente in pacientes" v-bind:value="paciente.id " v-bind:key="paciente.id" >
                {{ paciente.nome}}
                 </option>
                </select> 
        
            </div> 
            <div class="form-group">
                <h5>Clinica</h5>
               <select  class="form-control"  v-model="consulta.id_clinica">
                <option  value="">Escolha um item</option>
                <option v-for="clinica in clinicas" v-bind:value="clinica.id" v-bind:key="clinica.id">
                {{ clinica.nome}}
                 </option>
                </select> 
            </div>
            <div class="form-group">
                <h5>Data</h5>
                <input type="date" class="form-control" placeholder="Data da consulta" v-model="consulta.data_consulta">
            </div>
            <h5>Status</h5>
                        <select class="form-control" id="exampleFormControlSelect1" v-model="consulta.status">
                            <option>Realizado</option>
                             <option>Cancelado</option>
                             <option>Aguardando</option>
                        </select>
                        <br>
                <button type="submit" class="btn btn-success btn-block">Salvar</button>
            </form>
<div class="clearfix"></div>
<div class="table-responsive card-body  ">
    <table class=" table table-striped table-bordered table-ligth bg-white "  >
    <thead>
    <tr>
      <th >Medico</th>
      <th >Paciente</th>
      <th >Clinica</th>
      <th>Data</th>
      <th>Status</th>
      <th>Açoes</th>
    </tr>
  </thead>
  <tbody>
    <tr  class="table-active" v-for="consulta in consultas" v-bind:key="consulta.id">
      <th>{{consulta.nomeMedico}}</th>
      <td>{{consulta.nomePaciente}}</td>
      <td>{{consulta.nomeClinica}}</td>
      <td>{{consulta.data_consulta}}</td>
      <td>{{consulta.status}}</td>

      <td><button @click="deleteConsulta(consulta.id)" class="btn btn-danger mb-2"> Deletar</button>
      <td><button @click="editConsulta(consulta)" class="btn btn-warning mb-2"> Atualizar</button>

</td>
    </tr>
  <ul class="pagination">
    <li v-bind:class="[{disabled:!pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#"
    @click="fetchConsultas(pagination.prev_page_url)"
    >Previous</a></li>
    <li class="page-item disabled"><a class="page-link text-dark" href="#">Pagina {{pagination.current_page}} de {{pagination.last_page}}</a></li>

    <li v-bind:class="[{disabled:!pagination.next_page_url}]" class="page-item"><a class="page-link" href="#"
    @click="fetchConsultas(pagination.next_page_url)"
    >Next</a></li>
  </ul>
  </tbody>
    </table>
    </div>
  
    </div>

</template>
<script>
import { ModelSelect } from 'vue-search-select'

export default {
    data(){
        return{
            consultas:[],
            consulta:{
                id:'',
                id_medico:'',
                id_paciente:'',
                id_clinica:'',
                data_consulta:'',
                status:'',
                nomePaciente:'',
                nomeMedico:'',
                nomeClinica:''
           
           },
            medicos:[], medico:{
                id:'',
                nome:'',
                crm:'',
                email:'',
                especialidade:''
           
           },
           pacientes:[],paciente:{
                id:'',
                nome:'',
                sexo:'',
                idade:'',
                email:''
           
           },clinicas:[],clinica:{
                id:'',
                nome:'',
                cnes:'',
                proprietario:'',
                cnpj:''
           },
            errors: [],
            consulta_id:'',
            pagination:{},
            edit:false,

        }
         
        
    },
    created(){
        this.fetchConsultas();
        this.fetchMedicos();
        this.fetchPacientes();
        this.fetchClinicas();

    },
    methods:{
        fetchConsultas(page_url){
            let vm = this;
            
            page_url = page_url || '/api/consulta'
            fetch(page_url)
            .then(res=>res.json())
            .then(res=>{
                this.consultas = res.data;
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
      deleteConsulta(id){
          if (confirm('Tem certeza que quer exclir esse consulta')) {
                 fetch(`/api/consulta/${id}`,{
                     method:'delete'
                 })
                 .then(res =>res.json())
               .then(data =>{
                    alert('consulta removido');
                   this.fetchConsultas();
               })
               .catch(err=>console.log(err));
            }
         },
         addConsulta(){
             if(this.edit===false){
                //add 
               fetch('/api/consulta',{
                method:'post',
               body:JSON.stringify(this.consulta),
                headers :{
                    'content-type':'application/json',
                    'Accept': 'application/json'
                }
               })
                .then(res =>res.json())
                .then(data=> {
                   this.consulta.id_medico= '';
                   this.consulta.id_paciente= '';
                   this.consulta.id_clinica='';
                   this.consulta.data_consulta='';
                   this.consulta.status='';

                   alert('Registro inserido');
                   this.fetchConsultas();
               })
             }else{
                //edit
                if (confirm('Tem certeza que quer atualizar esse registro')) {
                     fetch('/api/consulta',{
                method:'put',
                body:JSON.stringify(this.consulta),
                headers :{
                     'content-type':'application/json',
                     'Accept': 'application/json'

            }
                }) 
                .then(res =>res.json())
               .then(data=> {
                    this.consulta.id_medico= '';
                   this.consulta.id_paciente= '';
                   this.consulta.id_clinica='';
                   this.consulta.data_consulta='';
                   this.consulta.status='';
                   alert('Registro atualizado');
                this.fetchConsultas();
                  this.edit = false;
                  this.consulta.id='';

              })
                 }
                 
                
             }
         },
         editConsulta(consulta){
             this.edit =true;
             this.consulta.id =consulta.id;
             this.consulta.consulta_id = consulta.id;
             this.consulta.id_medico=consulta.id_medico
             this.consulta.id_paciente= consulta.id_paciente;
             this.consulta.id_clinica= consulta.id_clinica;

             this.consulta.data_consulta=consulta.data_consulta;

             this.consulta.status=consulta.status;

         },checkForm: function (e) {
            
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        today = yyyy + '-' + mm + '-' +dd ;
        this.errors = [];

       if(this.consulta.data_consulta < today){
            this.errors.push('Não e posivel marcar uma consulta com data anterior a atual');
            
        }else if(this.consulta.id_medico && this.consulta.id_paciente && this.consulta.id_clinica && this.consulta.data_consulta && this.consulta.status){
        this.addConsulta();
            
        }
      if (!this.consulta.id_medico) {
        this.errors.push('E obrigatorio selecionar um medico');
      }
      if (!this.consulta.id_paciente) {
        this.errors.push('E obrigatorio selecionar um paciente.');
      }
      if (!this.consulta.id_clinica) {
        this.errors.push('E obrigatorio selecionar uma clinica.');
      }
        if (!this.consulta.data_consulta) {
        this.errors.push('E obrigatorio selecionar uma data para a consulta.');
      }
    if (!this.consulta.status) {
        this.errors.push('E obrigatorio selecionar um status para consulta.');
      }
      e.preventDefault();
    }, fetchMedicos(page_url){
            let vm = this;
            page_url = page_url || '/api/listarmedicos'
            fetch(page_url)
            .then(res=>res.json())
            .then(res=>{
                this.medicos = res.data;
               
            })
            .catch(err =>console.log(err));
        },fetchPacientes(page_url){
            let vm = this;
            page_url = page_url || '/api/listarpacientes'
            fetch(page_url)
            .then(res=>res.json())
            .then(res=>{
                this.pacientes = res.data;
            })
            .catch(err =>console.log(err));
        },fetchClinicas(page_url){
            let vm = this;
            page_url = page_url || '/api/listarclinicas'
            fetch(page_url)
            .then(res=>res.json())
            .then(res=>{
                this.clinicas = res.data;
            })
            .catch(err =>console.log(err));
        }


    }

}
</script>
