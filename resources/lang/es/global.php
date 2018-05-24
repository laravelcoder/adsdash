<?php

return [
		'user-management' => [		'title' => 'User management',		'fields' => [		],	],
		'permissions' => [		'title' => 'Permissions',		'fields' => [			'title' => 'Title',		],	],
		'roles' => [		'title' => 'Roles',		'fields' => [			'title' => 'Title',			'permission' => 'Permissions',		],	],
		'users' => [		'title' => 'Users',		'fields' => [			'name' => 'Name',			'email' => 'Email',			'password' => 'Password',			'role' => 'Role',			'remember-token' => 'Remember token',			'team' => 'Team',		],	],
		'management' => [		'title' => 'Advertiser Management',		'fields' => [		],	],
		'contact-companies' => [		'title' => 'Companies',		'fields' => [			'name' => 'Company name',			'address' => 'Address',			'website' => 'Website',			'email' => 'Email',		],	],
		'contacts' => [		'title' => 'Contacts',		'fields' => [			'company' => 'Company',			'first-name' => 'First name',			'last-name' => 'Last name',			'phone1' => 'Phone 1',			'phone2' => 'Phone 2',			'email' => 'Email',			'skype' => 'Skype',			'address' => 'Address',		],	],
		'internal-notifications' => [		'title' => 'Notifications',		'fields' => [			'text' => 'Text',			'link' => 'Link',			'users' => 'Users',		],	],
		'content-management' => [		'title' => 'Content management',		'fields' => [		],	],
		'content-categories' => [		'title' => 'Categories',		'fields' => [			'title' => 'Category',			'slug' => 'Slug',		],	],
		'content-tags' => [		'title' => 'Tags',		'fields' => [			'title' => 'Tag',			'slug' => 'Slug',		],	],
		'content-pages' => [		'title' => 'Pages',		'fields' => [			'title' => 'Title',			'category-id' => 'Categories',			'tag-id' => 'Tags',			'page-text' => 'Text',			'excerpt' => 'Excerpt',			'featured-image' => 'Featured image',		],	],
		'ads-dashboard' => [		'title' => 'Ads dashboard',		'fields' => [		],	],
		'channels' => [		'title' => 'Channels',		'fields' => [			'channel' => 'Channel',			'channel-name' => 'Channel name',		],	],
		'profiles' => [		'title' => 'Profiles',		'fields' => [			'image' => 'Image',			'created-by' => 'Created by',		],	],
		'client-management' => [		'title' => 'Client management',		'fields' => [		],	],
		'client-management-settings' => [		'title' => 'Client management settings',		'fields' => [		],	],
		'client-currencies' => [		'title' => 'Currencies',		'fields' => [			'title' => 'Title',			'code' => 'Code',			'main-currency' => 'Main currency',		],	],
		'client-transaction-types' => [		'title' => 'Transaction types',		'fields' => [			'title' => 'Title',		],	],
		'client-income-sources' => [		'title' => 'Income sources',		'fields' => [			'title' => 'Title',			'fee-percent' => 'Fee percent',		],	],
		'client-statuses' => [		'title' => 'Client statuses',		'fields' => [			'title' => 'Title',		],	],
		'client-project-statuses' => [		'title' => 'Project statuses',		'fields' => [			'title' => 'Title',		],	],
		'clients' => [		'title' => 'Clients',		'fields' => [			'first-name' => 'First name',			'last-name' => 'Last name',			'company-name' => 'Company',			'email' => 'Email',			'phone' => 'Phone',			'website' => 'Website',			'skype' => 'Skype',			'country' => 'Country',			'client-status' => 'Client status',		],	],
		'client-projects' => [		'title' => 'Projects',		'fields' => [			'title' => 'Title',			'client' => 'Client',			'description' => 'Description',			'date' => 'Start date',			'budget' => 'Budget',			'project-status' => 'Project status',		],	],
		'client-notes' => [		'title' => 'Notes',		'fields' => [			'project' => 'Project',			'text' => 'Note text',		],	],
		'client-documents' => [		'title' => 'Documents',		'fields' => [			'project' => 'Project',			'title' => 'Title',			'description' => 'Description',			'file' => 'File',		],	],
		'client-transactions' => [		'title' => 'Transactions',		'fields' => [			'project' => 'Project',			'transaction-type' => 'Transaction type',			'income-source' => 'Income source',			'title' => 'Title',			'description' => 'Description',			'amount' => 'Amount',			'currency' => 'Currency',			'transaction-date' => 'Transaction date',		],	],
		'assets-management' => [		'title' => 'Assets management',		'fields' => [		],	],
		'assets-categories' => [		'title' => 'Categories',		'fields' => [			'title' => 'Title',		],	],
		'assets-statuses' => [		'title' => 'Statuses',		'fields' => [			'title' => 'Title',		],	],
		'assets-locations' => [		'title' => 'Locations',		'fields' => [			'title' => 'Title',		],	],
		'assets' => [		'title' => 'Assets',		'fields' => [			'category' => 'Category',			'serial-number' => 'Serial number',			'title' => 'Title',			'photo1' => 'Photo1',			'photo2' => 'Photo2',			'photo3' => 'Photo3',			'status' => 'Status',			'location' => 'Location',			'assigned-user' => 'Assigned (user)',			'notes' => 'Notes',		],	],
		'assets-history' => [		'title' => 'Assets history',		'created_at' => 'Hora',		'fields' => [			'asset' => 'Asset',			'status' => 'Status',			'location' => 'Location',			'assigned-user' => 'Assigned (user)',		],	],
		'ads' => [		'title' => 'Ads',		'fields' => [			'link' => 'Link',			'ad-label' => 'Ad label',			'ad-type' => 'Ad type',			'created-by' => 'Created by',		],	],
		'ad-types' => [		'title' => 'Ad types',		'fields' => [			'codec' => 'Codec',			'extention' => 'Extention',		],	],
		'teams' => [		'title' => 'Teams',		'fields' => [			'name' => 'Name',		],	],
		'audiences' => [		'title' => 'Audiences',		'fields' => [			'name' => 'Name',			'value' => 'Value',			'created-by' => 'Created by',			'created-by-team' => 'Created by Team',		],	],
		'demographics' => [		'title' => 'Demographics',		'fields' => [			'demographic' => 'Demographic',			'value' => 'Value',			'created-by' => 'Created by',			'created-by-team' => 'Created by Team',		],	],
		'default-settings' => [		'title' => 'Default settings',		'fields' => [		],	],
		'default-settings' => [		'title' => 'Default Settings',		'fields' => [		],	],
		'user-base' => [		'title' => 'User Base',		'fields' => [			'name' => 'Name',			'value' => 'Value',			'created-by' => 'Created by',			'created-by-team' => 'Created by Team',		],	],
		'variables' => [		'title' => 'Variables',		'fields' => [			'name' => 'Name',			'value' => 'Value',		],	],
	'app_create' => 'Crear',
	'app_save' => 'Guardar',
	'app_edit' => 'Editar',
	'app_view' => 'Ver',
	'app_update' => 'Actualizar',
	'app_list' => 'Listar',
	'app_no_entries_in_table' => 'No hay entradas en la tabla',
	'app_custom_controller_index' => 'Índice de controlador personalizado.',
	'app_logout' => 'Salir',
	'app_add_new' => 'Agregar',
	'app_are_you_sure' => 'Estás seguro?',
	'app_back_to_list' => 'Regresar a la lista?',
	'app_dashboard' => 'Tablero de control',
	'app_delete' => 'Eliminar',
	'app_restore' => 'Restaurar',
	'app_permadel' => 'Borrar permanentemente',
	'app_all' => 'Todos',
	'app_trash' => 'Papelera',
	'app_delete_selected' => 'Eliminar seleccionado',
	'app_category' => 'Categoría',
	'app_categories' => 'Categorias',
	'app_title' => 'Título',
	'app_roles' => 'Roles',
	'app_role' => 'Rol',
	'app_user_management' => 'Gestión de usuarios',
	'app_users' => 'Usuarios',
	'app_user' => 'Usuario',
	'app_name' => 'Nombre',
	'app_email' => 'Correo',
	'app_password' => 'Contraseña',
	'app_remember_token' => 'Recordar token',
	'app_permissions' => 'Permisos',
	'app_client' => 'Cliente',
	'app_current_password' => 'Contraseña actual',
	'app_new_password' => 'Contraseña nueva',
	'app_password_confirm' => 'Confirmación de contraseña nueva',
	'app_dashboard_text' => 'Ha iniciado sesión',
	'app_forgot_password' => 'Olvidó su contraseña?',
	'app_remember_me' => 'Recuerdame',
	'app_login' => 'Iniciar sesión',
	'app_copy' => 'Copiar',
	'app_reset_password' => 'Reiniciar contraseña',
	'app_email_greet' => 'Hola',
	'app_confirm_password' => 'Confirma el password',
	'app_please_select' => 'Por favor seleccione',
	'app_questions' => 'Preguntas',
	'app_question' => 'Pregunta',
	'app_answer' => 'Respuesta',
	'app_project' => 'Proyecto',
	'app_expenses' => 'Gastos',
	'app_expense' => 'Gasto',
	'app_amount' => 'Cantidad',
	'app_address' => 'Dirección',
	'app_contacts' => 'Contactos',
	'app_first_name' => 'Nombre de pila',
	'app_last_name' => 'Apellido',
	'app_phone' => 'Teléfono',
	'app_category_name' => 'Nombre de la categoría',
	'app_products' => 'Productos',
	'app_product_name' => 'Nombre de producto',
	'app_price' => 'Precio',
	'app_tag' => 'Etiqueta',
	'app_photo1' => 'Foto1',
	'app_photo2' => 'Foto2',
	'app_photo3' => 'Foto3',
	'app_calendar' => 'Calendario',
	'app_tasks' => 'Tareas',
	'app_status' => 'Estado',
	'app_messages' => 'Mensajes',
	'app_you_have_no_messages' => 'No tienes mensajes.',
	'app_all_messages' => 'Todos los mensajes',
	'app_new_message' => 'Nouveau message',
	'app_change_password' => 'Cambiar contraseña',
	'app_csv' => 'CSV',
	'app_print' => 'Imprimir',
	'app_excel' => 'Excel',
	'app_colvis' => 'Visibilidad de columnas',
	'app_pdf' => 'PDF',
	'app_register' => 'Registrarse',
	'app_registration' => 'Registración',
	'app_not_approved_p' => 'La cuenta no ha sido aprovada por el Administrador. Por favor, sea paciente e intentelo nuevamente.',
	'app_whoops' => 'Whoops!',
	'app_serial_number' => 'Número de serie',
	'app_text' => 'Texto',
	'app_show' => 'Mostrar',
	'app_sample_category' => 'Ejemplo Categoria',
	'app_sample_question' => 'FAQ (Preguntas y Respuestas)',
	'app_sample_answer' => 'Respuesta Simple',
	'app_user_actions' => 'Acciones de Usuario (Traza)',
	'app_action' => 'Acciones',
	'app_description' => 'Descrcipción',
	'app_valid_from' => 'Válida desde',
	'app_valid_to' => 'Válido hasta',
	'app_discount_amount' => 'Importe de descuento',
	'app_discount_percent' => 'Porcentaje de descuento',
	'app_coupons_amount' => 'Cantidad de cupones',
	'app_coupons' => 'Cupones',
	'app_code' => 'Código',
	'app_redeem_time' => 'Canjear tiempo',
	'app_coupon_management' => 'Gestión de cupones',
	'app_time_management' => 'Gestión del tiempo',
	'app_projects' => 'Proyectos',
	'app_reports' => 'Informes',
	'app_time_entries' => 'Entradas de tiempo',
	'app_work_type' => 'Tipo de trabajo',
	'app_start_time' => 'Tiempo de Inicio',
	'app_end_time' => 'Hora de finalización',
	'app_expense_category' => 'Categoría de gastos',
	'app_expense_management' => 'Administración de gastos',
	'app_entry_date' => 'Fecha de entrada',
	'app_monthly_report' => 'Reporte mensual',
	'app_companies' => 'Compañias',
	'app_company_name' => 'Nombre de la Compañia',
	'app_website' => 'Sitio web',
	'app_contact_management' => 'Contactos Administracion',
	'app_company' => 'Compañia',
	'app_photo' => 'Foto(max 8mb)',
	'app_product_management' => 'Gestión del producto',
	'app_tags' => 'Etiquetas',
	'app_statuses' => 'Estados',
	'app_task_management' => 'Administración de tareas',
	'app_attachment' => 'Adjunto archivo',
	'app_due_date' => 'Fecha de vencimiento',
	'app_assigned_to' => 'Asignado A',
	'app_assets' => 'Bienes',
	'app_asset' => 'Activo',
	'app_location' => 'Ubicacion',
	'app_locations' => 'Lugar',
	'app_assigned_user' => 'Asignado(Usuario)',
	'app_notes' => 'Notas',
	'app_assets_history' => 'Historia de los activos',
	'app_assets_management' => 'Gestión de activos',
	'app_group_by' => 'Agrupar por',
	'app_chart_type' => 'Tipo de gráfico',
	'app_create_new_report' => 'Crear nuevo informe',
	'app_no_reports_yet' => 'No hay informes todavía',
	'app_created_at' => 'Creado el',
	'app_updated_at' => 'Actualizado el',
	'app_deleted_at' => 'Eliminado el',
	'app_outbox' => 'Envoyés',
	'app_inbox' => 'Inbox',
	'app_recipient' => 'Destinataire',
	'app_subject' => 'Motivo',
	'app_message' => 'Mensaje',
	'app_send' => 'Enviar',
	'app_reply' => 'Réplica',
	'app_country' => 'Pais',
	'app_file' => 'Archivo',
	'app_income_source' => 'Fuente de ingresos',
	'app_income_sources' => 'Fuentes de ingresos',
	'app_budget' => 'Presupuesto',
	'app_currency' => 'Divisa',
	'app_email_regards' => 'Saludos',
	'app_import_data' => 'Importar datos',
	'app_faq_management' => 'Gestión de preguntas frecuentes',
	'app_administrator_can_create_other_users' => 'Administrador (puede crear otros usuarios)',
	'app_simple_user' => 'Usuario simple',
	'app_action_model' => 'Modelo de Acción',
	'app_action_id' => 'ID de Acción',
	'app_time' => 'Hora',
	'app_campaign' => 'Campaña',
	'app_campaigns' => 'Campañas',
	'app_work_types' => 'Tipos de trabajo',
	'app_expense_categories' => 'Categorías de gastos',
	'app_income_categories' => 'Categorías de ingresos',
	'app_phone1' => 'Teléfono 1',
	'app_phone2' => 'Teléfono 2',
	'app_content_management' => 'Gestión de contenido',
	'app_excerpt' => 'Extracto',
	'app_featured_image' => 'Foto principal',
	'app_pages' => 'Paginas',
	'app_axis' => 'Eje',
	'app_reports_x_axis_field' => 'Eje X: elija uno de los campos de fecha / hora',
	'app_reports_y_axis_field' => 'Eje Y: elija uno de los campos numéricos',
	'app_select_crud_placeholder' => 'Seleccione uno de sus CRUDs',
	'app_select_dt_placeholder' => 'Seleccione uno de los campos de fecha / hora',
	'app_aggregate_function_use' => 'Función agregada para usar',
	'app_x_axis_group_by' => 'Grupo X-axis por',
	'app_x_axis_field' => 'Campo del eje X (fecha / hora)',
	'app_y_axis_field' => 'Campo del eje Y',
	'app_integer_float_placeholder' => 'Seleccione uno de los campos enteros / flotantes',
	'app_change_notifications_field_1_label' => 'Enviar notificación por correo electrónico al usuario',
	'app_change_notifications_field_2_label' => 'Cuando la entrada en CRUD',
	'app_select_users_placeholder' => 'Seleccione uno de sus usuarios',
	'app_is_created' => 'es creado',
	'app_is_updated' => 'esta actualizado',
	'app_is_deleted' => 'esta borrado',
	'app_notifications' => 'Notificaciones',
	'app_notify_user' => 'Notificar al usuario',
	'app_when_crud' => 'Cuando CRUD',
	'app_create_new_notification' => 'Crear nueva notificación',
	'app_upgrade_to_premium' => 'Actualizar a Premium',
	'app_calendar_sources' => 'Fuentes de calendario',
	'app_new_calendar_source' => 'Crear nueva fuente de calendario',
	'app_crud_title' => 'Título del CRUD',
	'app_crud_date_field' => 'Campo de fecha del CRUD',
	'app_prefix' => 'Prefijo',
	'app_label_field' => 'Campo de la etiqueta',
	'app_suffix' => 'Sufijo',
	'app_no_calendar_sources' => 'Sin fuentes de calendario todavía.',
	'app_crud_event_field' => 'Campo de etiqueta de evento',
	'app_create_new_calendar_source' => 'Crear una nueva fuente de calendario',
	'app_edit_calendar_source' => 'Editar fuente de calendario',
	'app_client_management' => 'Gestión de clientes',
	'app_client_management_settings' => 'Configuraciones de administración del cliente',
	'app_client_status' => 'Estado del Cliente',
	'app_clients' => 'Clientes',
	'app_client_statuses' => 'Estados del cliente',
	'app_currencies' => 'Divisas',
	'app_main_currency' => 'Divisa principal',
	'app_documents' => 'Documentos',
	'app_not_approved_title' => 'No estas aprovado',
	'app_there_were_problems_with_input' => 'Hubo problemas con esta entrada',
	'app_csvImport' => 'Importación CSV',
	'app_csv_file_to_import' => 'Archivo CSV a importar',
	'app_parse_csv' => 'Procesar CSV',
	'app_imported_rows_to_table' => 'Importación de :rows filas de  la tabla :table',
	'app_if_you_are_having_trouble' => 'Si tiene problemas para hacer clic en',
	'app_skype' => 'skype',
	'app_start_date' => 'Fecha inicio',
	'app_project_status' => 'Estado del proyecto',
	'app_transactions' => 'Actas',
	'app_fee_percent' => 'Por ciento de tarifa',
	'app_note_text' => 'Texto de nota',
	'app_project_statuses' => 'Estados del proyecto',
	'app_transaction_types' => 'Tipos de transacciones',
	'app_transaction_type' => 'Tipo de transacción',
	'app_transaction_date' => 'Fecha de Transacción',
	'app_reset_password_woops' => '<strong> Whoops! </ strong> Tenemos problemas en el campo:',
	'app_copy_paste_url_bellow' => 'botón, copie y pegue la siguiente URL en su navegador web:',
	'app_file_contains_header_row' => '¿El archivo contiene fila de encabezado?',
	'app_stripe_transactions' => 'Transacciones de Stripe',
	'app_email_line1' => 'Usted está recibiendo este correo electrónico porque recibimos una solicitud de restablecimiento de contraseña para su cuenta.',
	'app_email_line2' => 'Si no solicitó restablecer la contraseña, no se requieren más acciones.',
	'app_subscription-billing' => 'Suscripciones',
	'app_subscription-payments' => 'Pagos',
	'app_basic_crm' => 'CRM básico',
	'app_customers' => 'Clientes',
	'app_customer' => 'Cliente',
	'app_select_all' => 'Seleccionar todos',
	'app_deselect_all' => 'Deseleccionar',
	'app_slug' => 'Segmento',
	'app_team-management' => 'Equipos',
	'app_team-management-singular' => 'Equipo',
	'global_title' => 'adsdash',
];