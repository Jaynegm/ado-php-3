CREATE TABLE IF NOT EXISTS sabor_pizza (
  chave INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  nome TEXT NOT NULL,
  ingredientes TEXT NOT NULL,
  dt_inclusao REAL NOT NULL,
  dt_alteracao REAL NOT NULL,
  preco_sem_borda INTEGER NOT NULL,
  preco_com_borda INTEGER NOT NULL,
  doce INTEGER NOT NULL,
  CONSTRAINT chk_dt_inclusao CHECK (dt_inclusao IS NOT NULL),
  CONSTRAINT chk_dt_alteracao CHECK (dt_alteracao IS NOT NULL),
  CONSTRAINT chk_doce CHECK (doce = 0 OR doce = 1)
);

CREATE TABLE IF NOT EXISTS users (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL
);

