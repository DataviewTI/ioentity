<form action = '/admin/entity/create' id='default-form' method = 'post' class = 'form-fit'>
  @component('IntranetOne::io.components.wizard',[
    "_id" => "default-wizard",
    "_min_height"=>"435px",
    "_steps"=> [
        ["name" => "Dados Gerais", "view"=> "Entity::form-general"],
        ["name" => "Formas de Contato", "view"=> "Entity::form-contato"]
      ]
  ])
  @endcomponent
</form>