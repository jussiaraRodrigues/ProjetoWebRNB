package br.com.rbn.entity;

import jakarta.persistence.*;
import lombok.Data;

@Entity
@Data
public class ProdutoFornecedor {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;
//    @ManyToOne
//    private Fornecedor fornecedor;
    @ManyToOne
    private Produto produto;
    private float precoProduto;
}
