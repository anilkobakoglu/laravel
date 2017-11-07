				

1- ilk olarak= composer require "laravelcollective/html":"^5.4.0"  cmd ye bunu yaz.

2- ikinci olarak= config/app.php dosyasın da providerslerin altına bunu kopyala=  Collective\Html\HtmlServiceProvider::class,

3- son olarak = Aynı dosya içerisinde aliases ın altına = 'Form' => Collective\Html\FormFacade::class,
     													  'Html' => Collective\Html\HtmlFacade::class,		bunu kopyala.

 Bunları yaptıktan sonra html form u laravele göre düzenleyebilirsiniz..




 FORM AÇMAK= {Form::open(['url' => '/admin/ayarlar', 'method' => 'put'])}} veya {!! Form::open(['url' => 'foo/bar']) !!}

 fORM KAPATMAK= {!! Form::close() !!}

 iNPUT TEXT= {{ Form::text('title')}}<br>

 PAROLA= {{Form::password('password')}} 

 SUBMİT={{Form::submit('tıkla')}}

 cHECK BOX= {{ Form::checkbox('name', 'value')}}

 RADİO BUTTON: {{Form::radio('nameasd', 'valasue', true)}}  {{Form::radio('nameasd', 'value')}}

 SELECT RANGE= 	{{Form::selectRange('number', 10, 40)}}

 DOSYA YÜKLEME = {{Form::file('asd')}}   echo Form::file($name, $attributes = []);

 LABEL = {{Form::label('email', 'E-Mail Address')}}

NUMBER = {{Form::number('name', 'value')}}

DATE ={{Form::date('name', \Carbon\Carbon::now())}}

DROP-DOWN LİST ={{ Form::select('size', ['L' => 'Large', 'S' => 'Small'])}}


PLACEHOLDER KULLANIMI: , ['placeholder' => 'Paswoord']



-
 You may also open forms that point to named routes or controller actions:
 echo Form::open(['route' => 'route.name'])

echo Form::open(['action' => 'Controller@method'])
-








