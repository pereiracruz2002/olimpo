<?php

namespace PET\Models;

use Illuminate\Database\Eloquent\Model;

use DB;

class Animais extends Model
{
    protected $table = 'animais';
    protected $primaryKey = 'animais_id';

    protected $fillable = array(
            'nome',
            'sexo',
            'raca',
            'mesma_raca',
            'tipos_id',
            'users_id',
            'imagem',
            'distancia',
            'porte',
            'descricao'
            );

    public function tipos()
    {
        return $this->belongsTo(Tipos::class);
    }

    public function users()
    {
        return $this->belongsTo(Users::class);
    }

    public function endereco()
    {
        return $this->hasOne(Enderecos_animais::class);
    }
    public function salas_combinacoes()
    {
        return $this->hasOne(Salas_combinacoes::class);
    }

    public function match()
    {
        return $this->hasOne(Match::class);
    }

    public function buscaPars($animal,$rejeitados,$quantidade = 50,$inicio = 0){

        $jamatches = array();




        $item = DB::table('matches');

        $item->where("animal1","=",$animal->animais_id);
        $item->orWhere("animal2","=",$animal->animais_id);

        $total = $item->get();

        foreach ($total as $animalmatch) {

            if($animalmatch->animal1  != $animal->animais_id){
                $jamatches[] = $animalmatch->animal1;
            }else{
                $jamatches[] = $animalmatch->animal2;
            }


        }

        $animais = DB::table('animais');

        if($animal->endereco->latitude != "" && $animal->endereco->longitude != ""){
            $animais->select(DB::raw('animais.*,users.users_id,users.nome as dono,users.imagem as imagemdono,users.email,enderecos_animais.*,(6371 * acos (cos ( radians('.$animal->endereco->latitude.') )* cos( radians(enderecos_animais.latitude ) )* cos( radians( enderecos_animais.longitude ) - radians('.$animal->endereco->longitude.') )+ sin ( radians('.$animal->endereco->latitude.') ) * sin( radians( enderecos_animais.latitude ) ))) as localizacao'));
        }else{
            $animais->select(DB::raw('animais.*,users.users_id,users.nome as dono,users.imagem as imagemdono,users.email,enderecos_animais.*,(6371 * acos (cos ( radians('.$animal->users->latitude.') )* cos( radians(enderecos_animais.latitude ) )* cos( radians( enderecos_animais.longitude ) - radians('.$animal->users->longitude.') )+ sin ( radians('.$animal->users->latitude.') ) * sin( radians( enderecos_animais.latitude ) ))) as localizacao'));
        }

        $animais->join('users', 'users.users_id', '=', 'animais.users_id');
        $animais->join('enderecos_animais', 'enderecos_animais.animais_id', '=', 'animais.animais_id');


        if($animal->mesma_raca == "sim"){
            $animais->where('animais.raca',$animal->raca);
        }

        if($animal->sexo == "macho"){
            $animais->where('animais.sexo','femea');
        }else{
            $animais->where('animais.sexo','macho');
        }

        $animais->where('animais.users_id',"!=",$animal->users->users_id);

        $animais->where('animais.users_id',"!=",$animal->users->users_id);

        if(count($rejeitados) > 0){

            $animais->whereNotIn('animais.animais_id', $rejeitados);

        }

        $animais->whereNotIn('animais.animais_id', $jamatches);

        $animais->having('localizacao','<',$animal->distancia);
        $animais->orderBy('animais.animais_id', 'desc');



        if($inicio > 0){
            $animais->skip($inicio);
            $animais->take($quantidade);
        }else{
            $animais->take($quantidade);
        }

        $animais->groupBy('animais.animais_id');

        $resultado = $animais->get();






        return $resultado;

    }






}
