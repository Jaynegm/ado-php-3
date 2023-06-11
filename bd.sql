CREATE TABLE sabor_pizza (
chave INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
nome TEXT NOT NULL,
ingredientes TEXT NOT NULL,
preco_sem_borda INTEGER NOT NULL,
preco_borda_recheada INTEGER NOT NULL, 
doce INTEGER NOT NULL CHECK (doce IN (0, 1))
);