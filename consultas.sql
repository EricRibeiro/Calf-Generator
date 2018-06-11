-- TOTAL DE NOVILHAS NO PROTOCOLO
select count(distinct ia.id_animal) from IA ia
	join Protocolo p on ia.id_protocolo = p.id
    join Cronologia c on ia.id_animal = c.id_animal
where p.id = 1
and c.id_classificacao = 1;

-- NUMERO DE NOVILHAS REPETIU
-- SELECT count(distinct ia1.id_animal) FROM IA ia1 
SELECT count(distinct ia1.id_animal) FROM IA ia1
JOIN IA ia2 ON ia1.id_animal = ia2.id_animal
Join Cronologia c on ia1.id = c.id_ia
WHERE ia2.id_protocolo = 2
AND ia1.id_protocolo < 2
and c.id_classificacao = 1;


-- NUMERO DE NOVILHAS PRENHAS
SELECT count(ia.id_animal) FROM IA ia
join Cronologia c1 on ia.id = c1.id_ia
left outer join Cronologia c2 on (ia.id = c2.id_ia AND c1.id < c2.id)
WHERE ia.id_protocolo = 1
and c1.id_classificacao = 1
and c2.id IS NULL
and ((c1.id_estadoInicial = 4 AND c1.id_estadoFinal IS NULL) OR (c1.id_estadoInicial = 3 AND c1.id_estadoFinal = 4))


    
    