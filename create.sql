CREATE TABLE "incluye" (
  "pedido" integer NOT NULL,
  "producto" integer NOT NULL,
  "cantidad" real NOT NULL,
  FOREIGN KEY ("pedido") REFERENCES "pedidos" ("id"),
  FOREIGN KEY ("producto") REFERENCES "productos" ("id")
);

CREATE TABLE "pedidos" (
  "id" INTEGER NOT NULL,
  "usuario" integer NOT NULL,
  "sucursal" integer NOT NULL,
  PRIMARY KEY ("id"),
  FOREIGN KEY ("usuario") REFERENCES "usuarios" ("id"),
  FOREIGN KEY ("sucursal") REFERENCES "sucursales" ("id")
);

CREATE TABLE "productos" (
  "id" INTEGER NOT NULL,
  "descripcion" text NOT NULL,
  "precio" real NOT NULL,
  PRIMARY KEY ("id")
);

CREATE TABLE "sucursales" (
  "id" INTEGER NOT NULL,
  "nombre" text NOT NULL,
  "direccion" text NOT NULL,
  "ciudad" text NOT NULL,
  PRIMARY KEY ("id")
);

CREATE TABLE "usuarios" (
  "id" INTEGER NOT NULL,
  "username" TEXT NOT NULL,
  "password" TEXT NOT NULL,
  PRIMARY KEY ("id")
);

