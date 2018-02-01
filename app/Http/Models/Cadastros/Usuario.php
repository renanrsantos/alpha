<?php
namespace App\Http\Models\Cadastros;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Http\Models\Model;
use App\Http\Models\Estrutura\Perfilrotina;
use App\Http\Models\Estrutura\Rotina;

class Usuario extends Authenticatable
{
    use Notifiable;
    
    protected $modulo;
    protected $tabela;
    
    private $modulosUsuario = null;
    private $rotinasUsuario = null;
    
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
        foreach($this->perfis as $perfil){
            $perfis[] = $perfil->idperfil;
        }
        return $perfis;
    }
    
    public function rotinas(){
        $rotinas = [];
        foreach(Perfilrotina::whereIn('idperfil',$this->perfisToArray())->get() as $perfilRotina){
            if($perfilRotina->modulo){
                foreach(Rotina::where('idmodulo',$perfilRotina->modulo->idmodulo)->get() as $rotina){
                    $rotinas[] = $rotina;
                }
            } else {
                $rotinas[] = $perfilRotina->rotina;
            }
        }
        return $rotinas;
    }
    
    public function getModulos(){
        if($this->modulosUsuario === null){
            $ids = [];
            $this->modulosUsuario = [];
            foreach($this->rotinas() as $rotina){
                if(array_search($rotina->idmodulo, $ids) === false){
                    $ids[] = $rotina->idmodulo;
                    $this->modulosUsuario[] = $rotina->modulo;
                }
            }
            usort($this->modulosUsuario, function($a, $b){
                return $a->modordem - $b->modordem;
            });
        }
        return $this->modulosUsuario;
    }
    
    public function getRotinas($modulo){
        if($this->rotinasUsuario === null){
            $this->rotinasUsuario = $this->rotinas();
            usort($this->rotinasUsuario, function($a, $b){
                return $a->rotordem - $b->rotordem;
            });
        }
        $rotinas = [];
        foreach($this->rotinasUsuario as $rotina){
            if($rotina->idmodulo === $modulo->idmodulo){
                $rotinas[] = $rotina;
            }
        }
        return $rotinas;
    }
}