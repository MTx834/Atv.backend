// Interface para diferentes tipos de pizza (OCP e DIP)
interface Pizza {
    public function preparar();
    public function calcularPreco();
}

// Implementação de pizzas específicas
class PizzaMarguerita implements Pizza {
    public function preparar() {
        echo "Preparando pizza marguerita\n";
    }

    public function calcularPreco() {
        return 25.0;
    }
}

class PizzaCalabresa implements Pizza {
    public function preparar() {
        echo "Preparando pizza calabresa\n";
    }

    public function calcularPreco() {
        return 30.0;
    }
}

// Classe para realizar pedidos de pizza (SRP)
class Pedido {
    private $pizza;

    public function __construct(Pizza $pizza) {
        $this->pizza = $pizza;
    }

    public function realizar() {
        $this->pizza->preparar();
        $preco = $this->pizza->calcularPreco();
        echo "Preço da pizza: R$ $preco\n";
    }
}

// Factory para criar tipos de pizza (Factory Pattern - Refatoração para SRP e OCP)
class PizzaFactory {
    public static function criarPizza($tipo) {
        switch($tipo) {
            case 'marguerita':
                return new PizzaMarguerita();
            case 'calabresa':
                return new PizzaCalabresa();
            default:
                throw new Exception("Tipo de pizza desconhecido");
        }
    }
}

// Exemplo de uso:
try {
    // Usando a factory para criar uma pizza específica
    $pizza = PizzaFactory::criarPizza('marguerita');
    
    // Criando um pedido para essa pizza
    $pedido = new Pedido($pizza);
    $pedido->realizar();
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
