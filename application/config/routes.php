<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rotas do Site -- front end
$route['404_override']                              = '';
$route['default_controller']                        = "backend/users/login";


// Rotas Admin -- backend
//Rotas de Login e Segurança
$route['admin']							            = 'backend/users/login';
$route['admin/sair']								= 'backend/users/logout';
$route['admin/perfil']							    = 'backend/users/profile';

//Rotas de Usuários
$route['admin/usuarios']							= 'backend/users';
$route['admin/usuarios/(:num)']				    	= 'backend/users/index/$1';
$route['admin/usuarios/adicionar']				    = 'backend/users/create';
$route['admin/usuarios/editar/(:num)/(:any)']       = 'backend/users/update/$1/$2';
$route['admin/usuarios/remover/(:num)/(:any)']      = 'backend/users/delete/$1/$2';

//Rotas de Grupos de Usuários
$route['admin/grupos']							    = 'backend/user_groups';
$route['admin/grupos/(:num)']						= 'backend/user_groups/index/$1';
$route['admin/grupos/adicionar']					= 'backend/user_groups/create';
$route['admin/grupos/editar/(:num)']				= 'backend/user_groups/update/$1';
$route['admin/grupos/remover/(:num)']				= 'backend/user_groups/delete/$1';

//Rotas de Parâmetros
$route['admin/parametros']						    = 'backend/parameters';
$route['admin/parametros/(:num)']					= 'backend/parameters/index/$1';
$route['admin/parametros/adicionar']				= 'backend/parameters/create';
$route['admin/parametros/editar/(:num)']			= 'backend/parameters/update/$1';
$route['admin/parametros/remover/(:num)']			= 'backend/parameters/delete/$1';

//Rotas de Módulos do Sistema
$route['admin/modulos']							    = 'backend/modules';
$route['admin/modulos/(:num)']					    = 'backend/modules/index/$1';
$route['admin/modulos/adicionar']					= 'backend/modules/create';
$route['admin/modulos/editar/(:num)']				= 'backend/modules/update/$1';
$route['admin/modulos/remover/(:num)']			    = 'backend/modules/delete/$1';

//Rotas de Páginas
$route['admin/paginas']							    = 'backend/pages';
$route['admin/paginas/(:num)/(:any)']			    = 'backend/pages/update/$1/$2';

/* End of file routes.php */
/* Location: ./application/config/routes.php */