package br.com.rbn.repository;

import br.com.qualquercoisa.ecommerce.entity.ProdutoFornecedor;
import org.springframework.data.repository.CrudRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface ProdutoFornecedorRepository extends CrudRepository<ProdutoFornecedor, Long> {
}
