<<?php 

/**
 * classe CiudadesList
 * registro de ciudades: contiene el formulario del listado
 */
class CiudadesList extends TPage {
	private $form; //formulario registro
	private $datagrid; //listado

	/**
 	* método constructor
 	* Crea una página, el formulario del listado
 	*/
	function __construct()
	{
		parent::__construct();

		//instancia un formulario
		$this->form = new Tform('form_ciudades');
		//instancia una tabla
		$table = new TTable;

		//agrega una tabla al formulario
		$this->form->add($table);

		//crea los campos del formulario
		$codigo = new TEntry('id');
		$descripcion = new TEntry('nombre');
		$estado = new TCombo('estado');

		//crea los campos con las opciones de combo
		$items = array();
		$items['RS'] = 'Rio Grande dp Sul';
		$items['SP'] = 'Sao Paulo';
		$items['MG'] = 'Minas Gerais';
		$items['PR'] = 'Paraná';

		//agrega las opciones en combo
		$estado->addItems($items);

		//define el tamanho de los campos
		$codigo->setSize(40);
		$estado->setSize(200);

		//agrega una linha para el campo código
		$row = $table->addRow();
		$row->addCell(new TLabel('Código:'));
		$row->addCell($codigo);

		//agrega una linha para el campo descripción
		$row = $table->addRow();
		$row->addCell(new TLabel('Estado:'));
		$row->addCell($estado);

		//crea un boton de accion (salvar)
		$save_button = new TButton('save');

		//define la accion del boton
		$save_button->setAction(new TAction(array($this, 'onSave')), 'Salvar');

		//agrega una linea para la acción del formulario
		$row = $table->addRow();
		$row->addCell($save_button);

		//define cuales son los campos del formulario
		$this->form->setFields(array($codigo, $descripcion, $estado, $save_button));

		//instancia el objeto DataGrid
		$this->datagrid = new DataGrid;

		//instancia las columnas en DataGrid
		$codigo = new TDataGridColumn('id', 'Codigo', 'right', 50);
		$nombre = new TDataGridColumn('nombre', 'Nombre', 'left', 200);
		$estado = new TDataGridColumn('estado', 'Estado', 'left', 40);

		//agrega las columas a DataGrid
		$this->datagrid->addColumn($codigo);
		$this->datagrid->addColumn($nombre);
		$this->datagrid->addColumn($estado);

		//instancia dos acciones de DataGrid
		$action1 = new TDataGridAction(array($this, 'oneEdit'));
		$action1->setLabel('Editar'):
		$action1->setImage('ico_edit.png');
		$action1->setField('id');

		$action2 = new TDataGridAction(array($this, 'oneDelete'));
		$action2->setLabel('Deletar'):
		$action2->setImage('ico_delete.png');
		$action2->setField('id');

		//agregar las acciones a DataGrid
		$this->datagrid->addAction($action1);
		$this->datagrid->addAction($action2);

		//crea el modelo de DataGrid, montando su estructura
		$this->datagrid->createModel();

		// monta la pagina a traves de una tabla
		$table = new TTable;

		//crea una linea para el formulario
		$row = $table->addRow();
		$row->addCell($this->form);

		//crea una linea para la datagrid
		$row = $table->addRow();
		$row->addCell($this->datagrid);

		//agrega a la tabla la página
		parent::add($table);

	}
}

 ?>