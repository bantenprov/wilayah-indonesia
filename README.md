# wilayah-indonesia

[![Join the chat at https://gitter.im/wilayah-indonesia/Lobby](https://badges.gitter.im/wilayah-indonesia/Lobby.svg)](https://gitter.im/wilayah-indonesia/Lobby?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/bantenprov/wilayah-indonesia/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/bantenprov/wilayah-indonesia/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/bantenprov/wilayah-indonesia/badges/build.png?b=master)](https://scrutinizer-ci.com/g/bantenprov/wilayah-indonesia/build-status/master)
[![Latest Stable Version](https://poser.pugx.org/bantenprov/wilayah-indonesia/v/stable)](https://packagist.org/packages/bantenprov/wilayah-indonesia)
[![Total Downloads](https://poser.pugx.org/bantenprov/wilayah-indonesia/downloads)](https://packagist.org/packages/bantenprov/wilayah-indonesia)
[![Latest Unstable Version](https://poser.pugx.org/bantenprov/wilayah-indonesia/v/unstable)](https://packagist.org/packages/bantenprov/wilayah-indonesia)
[![License](https://poser.pugx.org/bantenprov/wilayah-indonesia/license)](https://packagist.org/packages/bantenprov/wilayah-indonesia)
[![Monthly Downloads](https://poser.pugx.org/bantenprov/wilayah-indonesia/d/monthly)](https://packagist.org/packages/bantenprov/wilayah-indonesia)
[![Daily Downloads](https://poser.pugx.org/bantenprov/wilayah-indonesia/d/daily)](https://packagist.org/packages/bantenprov/wilayah-indonesia)

Daftar nama Provinsi, Kabupaten, Kota, Kecamat dan desa yang ada di Indonesia

# Dependency Package
This package is made for Tanara Dashboard, it's need other package:
https://github.com/laravolt/indonesia

# Installing Dependency Package (Laravolt\Indonesia\)
Add this line of cone to:
```
'providers' => [

    Laravolt\Indonesia\ServiceProvider::class

]
```

```
'aliases' => [

    'Indonesia' => Laravolt\Indonesia\Facade::class

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

# Instlaling Wilayah Indonesia to Tanara
Install Wilayan Indonesia Package:
```
composer require bantenprov/wilayah-indonesia
```
Add this line of code to config/app.php:
```
'providers' => [
		Bantenprov\WilayahIndonesia\WilayahIndonesiaServiceProvider::class,
]
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
Add this line of codes to components.js:
```
//COMPONEN WILAYAH INDONESIA//
// WILAYAH PROVINSI INDONESIA//
import WilayahIndonesiaProvinsiTable from './components/views/bantenprov/wilayah-indonesia/provinsi/WilayahIndonesiaProvinsiTable.vue';
Vue.component('wilayah_indonesia_provinsi_table', TableProvinsi);

```
You should see menu Wilayah Indonesia on left side :)