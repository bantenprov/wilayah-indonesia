# wilayah-indonesia
Daftar nama Provinsi, Kabupaten, Kota, Kecamat dan desa yang ada di Indonesia

## Dependency Package
This package is made for Tanara Dashboard, it needs other package:
https://github.com/laravolt/indonesia
You need to install wilayah-indonesia first then the dependency package.

## Installing Wilayah Indonesia to Tanara
Install Wilayah Indonesia Package:
```
composer require bantenprov/wilayah-indonesia:dev-master
```


## Installing Dependency Package (Laravolt\Indonesia\)
Add this line of code to:
```
'providers' => [

    Laravolt\Indonesia\ServiceProvider::class,

]
```

```
'aliases' => [

    'Indonesia' => Laravolt\Indonesia\Facade::class,

]
```
Publish dependency package with this command:
```
php artisan vendor:publish --provider="Laravolt\Indonesia\ServiceProvider"
```
Run your migrate:
```
php artisan migrate
```
Fill table with seed:
```
php artisan laravolt:indonesia:seed
```

## Since now we configure this package.

Add this line of code to config/app.php:
```
'providers' => [
		Bantenprov\WilayahIndonesia\WilayahIndonesiaServiceProvider::class,
]
```
Type this command to publish components:
```
php artisan vendor:publish --tag=wilayah-indonesia-assets
```
To update please use:
```
php artisan vendor:publish --tag=wilayah-indonesia-assets --force
```
Add this line of codes to menu.js:
=======

Add this line of codes to components.js:
```
// PROVINSI //
import WilayahIndonesiaProvinsiTable from './components/views/bantenprov/wilayah-indonesia/provinsi/WilayahIndonesiaProvinsiTable.vue';
Vue.component('wilayah_indonesia_provinsi_table', TableProvinsi);

// KABUPATEN //
import WilayahIndonesiaKabupatenTable from './components/views/bantenprov/wilayah-indonesia/kabupaten/WilayahIndonesiaKabupatenTable.vue';
Vue.component('WilayahIndonesiaKabupatenTable', WilayahIndonesiaKabupatenTable);

// KECAMATAN //
import WilayahIndonesiaKecamatanTable from './components/views/bantenprov/wilayah-indonesia/kecamatan/WilayahIndonesiaKecamatanTable.vue';
Vue.component('WilayahIndonesiaKecamatanTable', WilayahIndonesiaKecamatanTable);

// DESA //
import WilayahIndonesiaDesaTable from './components/views/bantenprov/wilayah-indonesia/desa/WilayahIndonesiaDesaTable.vue';
Vue.component('WilayahIndonesiaDesaTable', WilayahIndonesiaDesaTable);

```
Add this line of codes to routes.js:
```
  //ROUTE PROVINSI WILAYAH INDONESIA
	{
		path: '/wilayah-indonesia/provinsi',
		redirect: '/wilayah-indonesia/provinsi',
		component: layout('Default'),
		children: [
			{
				path: '/wilayah-indonesia/provinsi',
				components: {
					main: resolve => require(['./components/views/bantenprov/wilayah-indonesia/provinsi/WilayahIndonesiaProvinsi.vue'], resolve),
					navbar: resolve => require(['./components/Navbar.vue'], resolve),
					sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
				},
				meta: {
					title: "Data Provinsi"
				}
			},
			{
				path: '/wilayah-indonesia/provinsi/form',
				components: {
					main: resolve => require(['./components/views/bantenprov/wilayah-indonesia/provinsi/WilayahIndonesiaProvinsiForm.vue'], resolve),
					navbar: resolve => require(['./components/Navbar.vue'], resolve),
					sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
				},
				meta: {
					title: "Data Provinsi"
				}
			},
			{
				path: '/wilayah-indonesia/provinsi/form/:id',
				components: {
					main: resolve => require(['./components/views/bantenprov/wilayah-indonesia/provinsi/WilayahIndonesiaProvinsiForm.vue'], resolve),
					navbar: resolve => require(['./components/Navbar.vue'], resolve),
					sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
				},
				meta: {
					title: "Data Provinsi"
				}
			},
		]
	},
	//END ROUTE PROVINSI WILAYAH INDONESIA
	
	//ROUTE KABUPATEN WILAYAH INDONESIA
	{
		path: '/wilayah-indonesia/kabupaten',
		redirect: '/wilayah-indonesia/kabupaten',
		component: layout('Default'),
		children: [
			{
				path: '/wilayah-indonesia/kabupaten',
				components: {
					main: resolve => require(['./components/views/bantenprov/wilayah-indonesia/kabupaten/WilayahIndonesiaKabupaten.vue'], resolve),
					navbar: resolve => require(['./components/Navbar.vue'], resolve),
					sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
				},
				meta: {
					title: "Data Kabupaten"
				}
			},
			{
				path: '/wilayah-indonesia/kabupaten/form',
				components: {
					main: resolve => require(['./components/views/bantenprov/wilayah-indonesia/kabupaten/WilayahIndonesiaKabupatenForm.vue'], resolve),
					navbar: resolve => require(['./components/Navbar.vue'], resolve),
					sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
				},
				meta: {
					title: "Data Kabupaten"
				}
			},
			{
				path: '/wilayah-indonesia/kabupaten/form/:id',
				components: {
					main: resolve => require(['./components/views/bantenprov/wilayah-indonesia/kabupaten/WilayahIndonesiaKabupatenForm.vue'], resolve),
					navbar: resolve => require(['./components/Navbar.vue'], resolve),
					sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
				},
				meta: {
					title: "Data Kabupaten"
				}
			},
		]
	},
	//END ROUTE KABUPATEN WILAYAH INDONESIA

	//ROUTE KECAMATAN WILAYAH INDONESIA
	{
		path: '/wilayah-indonesia/kecamatan',
		redirect: '/wilayah-indonesia/kecamatan',
		component: layout('Default'),
		children: [
			{
				path: '/wilayah-indonesia/kecamatan',
				components: {
					main: resolve => require(['./components/views/bantenprov/wilayah-indonesia/kecamatan/WilayahIndonesiaKecamatan.vue'], resolve),
					navbar: resolve => require(['./components/Navbar.vue'], resolve),
					sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
				},
				meta: {
					title: "Data Kecamatan"
				}
			},
			{
				path: '/wilayah-indonesia/kecamatan/form',
				components: {
					main: resolve => require(['./components/views/bantenprov/wilayah-indonesia/kecamatan/WilayahIndonesiaKecamatanForm.vue'], resolve),
					navbar: resolve => require(['./components/Navbar.vue'], resolve),
					sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
				},
				meta: {
					title: "Data Kecamatan"
				}
			},
			{
				path: '/wilayah-indonesia/kecamatan/form/:id',
				components: {
					main: resolve => require(['./components/views/bantenprov/wilayah-indonesia/kecamatan/WilayahIndonesiaKecamatanForm.vue'], resolve),
					navbar: resolve => require(['./components/Navbar.vue'], resolve),
					sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
				},
				meta: {
					title: "Data Kecamatan"
				}
			},
		]
	},
	//END ROUTE KECAMATAN WILAYAH INDONESIA

	//ROUTE DESA WILAYAH INDONESIA
	{
		path: '/wilayah-indonesia/desa',
		redirect: '/wilayah-indonesia/desa',
		component: layout('Default'),
		children: [
			{
				path: '/wilayah-indonesia/desa',
				components: {
					main: resolve => require(['./components/views/bantenprov/wilayah-indonesia/desa/WilayahIndonesiaDesa.vue'], resolve),
					navbar: resolve => require(['./components/Navbar.vue'], resolve),
					sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
				},
				meta: {
					title: "Data Desa"
				}
			},
			{
				path: '/wilayah-indonesia/desa/form',
				components: {
					main: resolve => require(['./components/views/bantenprov/wilayah-indonesia/desa/WilayahIndonesiaDesaForm.vue'], resolve),
					navbar: resolve => require(['./components/Navbar.vue'], resolve),
					sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
				},
				meta: {
					title: "Data Desa"
				}
			},
			{
				path: '/wilayah-indonesia/desa/form/:id',
				components: {
					main: resolve => require(['./components/views/bantenprov/wilayah-indonesia/desa/WilayahIndonesiaDesaForm.vue'], resolve),
					navbar: resolve => require(['./components/Navbar.vue'], resolve),
					sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
				},
				meta: {
					title: "Data Desa"
				}
			},
		]
	},
	//END ROUTE DESA WILAYAH INDONESIA

```

Add this line of codes to menu.js:
```
  {
    name: 'Wilayah Indonesia',
    icon: 'fa fa-play-circle',
    childType: 'collapse',
    childItem: [
		{
			name: 'Provinsi',
			link: '/wilayah-indonesia/provinsi',
			icon: 'fa fa-angle-right'
		},
		{
			name: 'Kabupaten',
			link: '/wilayah-indonesia/kabupaten',
			icon: 'fa fa-angle-right'
		},
		{
			name: 'Kecamatan',
			link: '/wilayah-indonesia/kecamatan',
			icon: 'fa fa-angle-right'
		},
		{
			name: 'Desa',
			link: '/wilayah-indonesia/desa',
			icon: 'fa fa-angle-right'
		},
	]
  },

```

> You should see menu Wilayah Indonesia on left side :)