# wilayah-indonesia
Daftar nama Provinsi, Kabupaten, Kota, Kecamat dan desa yang ada di Indonesia

## Dependency Package
This package is made for Tanara Dashboard, it needs other package:
https://github.com/laravolt/indonesia
You need to install wilayah-indonesia first then the dependency package.

## Installing Wilayah Indonesia to Tanara
### Install Wilayah Indonesia Package:
```
composer require bantenprov/wilayah-indonesia:dev-master
```


## Installing Dependency Package (Laravolt\Indonesia\)
### Add this line of code to:
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
### Publish dependency package with this command:
```
php artisan vendor:publish --provider="Laravolt\Indonesia\ServiceProvider"
```
### Run your migrate:
```
php artisan migrate
```
### Fill table with seed:
```
php artisan laravolt:indonesia:seed
```

## Since now we configure this package.

### Add this line of code to config/app.php:
```
'providers' => [
		Bantenprov\WilayahIndonesia\WilayahIndonesiaServiceProvider::class,
]
```

### Add this line of codes to components.js:
```
//COMPONEN WILAYAH INDONESIA//
// WILAYAH PROVINSI INDONESIA//
import WilayahIndonesiaProvinsiTable from './components/views/bantenprov/wilayah-indonesia/provinsi/WilayahIndonesiaProvinsiTable.vue';
Vue.component('wilayah_indonesia_provinsi_table', TableProvinsi);

```
### Add this line of codes to routes.js:
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
					main: resolve => require(['./components/views/bantenprov/wilayah-indonesia/provinsi/WilayahIndonesiaProvinsiProvinsi.vue'], resolve),
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

```

### Add this line of codes to menu.js:
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