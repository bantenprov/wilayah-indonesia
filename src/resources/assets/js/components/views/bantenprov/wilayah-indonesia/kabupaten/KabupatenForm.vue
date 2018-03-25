<template>
  <div>
  <div id="">
    <div class="alert alert-info mb-5" role="alert">
          Data Successfully Process
    </div>
  </div>

    <h1>Formulir Provinsi</h1>
    <vue-form :state="formstate" :load="isiform" @submit.prevent="onSubmit" class="mb-3">
        <input type="hidden" name="post"/>
        <input type="hidden" v-model="model.id" name="id">
        <div class="col-sm mb-2">
          <validate tag="div">
            <label for="exampleInputEmail1">Pilih Provinsi</label>
			<v-select :options="options1" label="name" name="province_id" v-model="model.province_name" class="mb-4">
			  <template slot="option" slot-scope="option">
				{{ option.name }}
			  </template>
			</v-select>
            <field-messages name="id">
              <small class="form-text text-success">Pilih Provinsi!</small>
              <small class="form-text text-danger" slot="required">Kode Provinsi harus diisi</small>
            </field-messages>
          </validate>
        </div>
        <div class="col-sm mb-2">
          <validate tag="div">
            <label for="exampleInputEmail1">Kode Kabupaten</label>
            <input class="form-control" v-model="model.city_id" name="city_id" placeholder="ID Kabupaten">
            <field-messages name="id">
              <small class="form-text text-success">Bagus!</small>
              <small class="form-text text-danger" slot="required">Kode Kabupaten harus diisi</small>
            </field-messages>
          </validate>
        </div>
        <div class="col-sm mb-2">
          <validate tag="div">
            <label for="exampleInputEmail1">Nama Kabupaten</label>
            <input class="form-control" v-model="model.city_name" required name="city_name" placeholder="Nama Kabupaten">
            <field-messages name="name">
              <small class="form-text text-success">Looks good!</small>
              <small class="form-text text-danger" slot="required">Name Kabupaten harus diisi</small>
            </field-messages>
          </validate>
        </div>
        <div class="col-auto mb-2">
          <button class="btn btn-primary" type="submit">Submit</button>
        </div>
    </vue-form>
  </div>
</template>

<script>
export default {
  data () {
    return {
		formstate: {},
		model:{
			province_id: '',
			province_name: '',
			city_id: '',
			city_name: ''
		},
      options1: [],
    }
  },
  created: function(){
  },
  mounted:function(){
	axios.get('/wilayah-indonesia/provinsi/option').then(response => {
            this.options1 = response.data
    });
    var ref     = this;
	if (typeof this.$route.params.id !== 'undefined'){
		console.log('Ada ID');
		ref.isiform(ref);
	}else{
		console.log('Gak Ada ID');		
	}
  },
  methods: {
    onSubmit: function (){
		if(this.formstate.$invalid) {
			return;
		}else{
			if (typeof this.$route.params.id !== 'undefined'){
				axios.post('/wilayah-indonesia/kabupaten/'+this.$route.params.id+'/edit',{
					province_id : this.model.province_id,
					city_id : this.model.city_id,
					city_name : this.model.city_name
				})
				.then(function (response) {
					if(response.data.message === 'Success'){
						window.location.href = "/#/wilayah-indonesia/kabupaten";
						//this.$router.push("provinsi");
					}else{
						Vue.swal(
							'Error!',
							'Gagal Simpan Data!',
							'error'
						)
					}
				})
				.catch(function (error) {
					console.log(error);
				});				
			}else{
				axios.post('/wilayah-indonesia/kabupaten',{
					province_id : this.model.province_id,
					city_id : this.model.city_id,
					city_name : this.model.city_name
				})
				.then(function (response) {
					if(response.data.message === 'Success'){
						window.location.href = "/#/wilayah-indonesia/kabupaten";
						//this.$router.push("kabupaten");
					}else{
						alert('Gagal Proses');
					}
				})
				.catch(function (error) {
					console.log(error);
				});				
			}
		}
    },
    isiform: function(ref){
		axios.get('/wilayah-indonesia/kabupaten/'+ref.$route.params.id)
		.then(function (response) {
			console.log(response);
			if(response.data !== 'undefined'){
				ref.model.province_id   	= response.data.province_id,
				ref.model.province_name   	= response.data.province_name,
				ref.model.city_id   		= response.data.city_id,
				ref.model.city_name 		= response.data.city_name
			}
		});
    },
}
}
</script>
