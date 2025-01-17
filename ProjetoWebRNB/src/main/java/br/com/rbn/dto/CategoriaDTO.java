package br.com.rbn.dto;

import lombok.AllArgsConstructor;
import lombok.Data;

@Data
@AllArgsConstructor
public class CategoriaDTO {
    private String nome;
    private Long numeroDeSubcategorias;
}
