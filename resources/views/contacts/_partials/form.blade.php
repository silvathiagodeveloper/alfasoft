@include('includes.alerts')
<div class="form-group">
    <label for="name">Nome:</label>
    <input type="text" id="name" name="name" class="form-control" placeholder="Nome:" value="{{$contact->name ?? old('name')}}">
</div>
<div class="form-group">
    <label for="description">Contato:</label>
    <input type="text" id="contact" name="contact" class="form-control" placeholder="Contato:" value="{{$contact->contact ?? old('contact')}}">
</div>
<div class="form-group">
    <label for="name">Email:</label>
    <input type="text" id="email" name="email" class="form-control" placeholder="Email:" value="{{$contact->email ?? old('email')}}">
</div>
<button type="submit" class="btn btn-dark" id="btnSend"><i class="fas fa-save"></i> Enviar</button>