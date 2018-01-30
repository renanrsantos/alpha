<?php
namespace App\Http\Models\Cadastros;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Http\Models\Model;
use App\Http\Models\Estrutura\Perfilrotina;

class Usuario extends Authenticatable
{
    use Notifiable;
    
    protected $modulo;
    protected $tabela;
    
    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
        
        $this->incrementing = false;
        $this->timestamps = false;
        
        $class = explode('\\', strtolower(get_class($this)));
        $this->tabela = array_pop($class);
        $this->modulo = array_pop($class);
        $this->table = Model::getTableName($this->modulo, $this->tabela);
        
        $this->primaryKey = 'id' . $this->tabela;               
    }
    
    protected $fillable = [
        'usulogin', 'ususenha','usupermisao','usuadministrador'
    ];
    protected $hidden = [
        'ususenha','usutoken' 
    ];
    public function getAuthPassword(){
        return $this->ususenha;
    }
    protected $rememberTokenName = 'usutoken';
    
    public function pessoa(){
        return $this->belongsTo(Pessoa::class,'idpessoa','idpessoa');
    }
    
    public function perfis(){
        return $this->hasMany(Perfilusuario::class,'idusuario');
    }
    
    public function perfisToArray(){
        $perfis = [];
        foreach($this->perfis() as $perfil){
            $perfis[] = $perfil->idperfil;
        }
        return $perfis;
    }
    
    public function rotinas(){
        $rotinas = [];
        foreach(Perfilrotina::whereIn('idperfil',$this->perfisToArray()) as $perfilRotina){
            $rotinas[] = $perfilRotina->rotina();
        }
        return $rotinas;
    }
}