Use biblioteca;
-- --------------------------------------------------------------------------------
-- Routine DDL
-- Note: LISTAR TODAS 
-- --------------------------------------------------------------------------------
DELIMITER $$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Q_Prestamo_Contar`(INOUT pMensajeError VARCHAR(2000))
BEGIN
     
   -- Declaración de variables locales
   DECLARE cNombre_Logica VARCHAR(30) DEFAULT 'Lógica [sp_Q_Prestamo_Contar]';

   -- Declaración de bloque con Handler para manejo de SQLException
   DECLARE EXIT HANDLER FOR SQLEXCEPTION
   Handler_SqlException:
   BEGIN
      ROLLBACK;
      SET pMensajeError = CONCAT('Ocurrió un error al ejecutar el procedimiento. Lógica ', cNombre_Logica);
	  LEAVE Handler_SqlException;
   END;
   
   -- Ejecutar la Consulta
SELECT 
   count(*)
	FROM
    prestamos;
END$$

-- Routine DDL
-- Note: LISTAR TODAS 
-- --------------------------------------------------------------------------------
DELIMITER $$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Q_Prestamo_Listar`(limiteInicio int ,limiteCantidad int ,INOUT pMensajeError VARCHAR(2000))
BEGIN
     
   -- Declaración de variables locales
   DECLARE cNombre_Logica VARCHAR(30) DEFAULT 'Lógica [sp_Q_Prestamo_Listar]';

   -- Declaración de bloque con Handler para manejo de SQLException
   DECLARE EXIT HANDLER FOR SQLEXCEPTION
   Handler_SqlException:
   BEGIN
      ROLLBACK;
      SET pMensajeError = CONCAT('Ocurrió un error al ejecutar el procedimiento. Lógica ', cNombre_Logica);
	  LEAVE Handler_SqlException;
   END;
   
   -- Ejecutar la Consulta
	SELECT l.isbn, l.titulo,b.identificacion, b.nombre, le.carnet, le.nombre as 'Lector', p.fecha
	FROM libros l, bibliotecarios b, lectores le, prestamos p
	WHERE p.numero_referencia_libro= l.numero_referencia and
	p.identificacion_bibliotecario = b.identificacion and
	p.carnet_lector = le.carnet
	order by l.isbn desc
	limit limiteInicio, limiteCantidad;
END$$


-- --------------------------------------------------------------------------------
-- Routine DDL
-- Note: LISTAR TODAS LAE MESAS DEL RESTAURANTE
-- --------------------------------------------------------------------------------
DELIMITER $$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Q_Libro_Listar`(INOUT pMensajeError VARCHAR(2000))
BEGIN
     
   -- Declaración de variables locales
   DECLARE cNombre_Logica VARCHAR(30) DEFAULT 'Lógica [sp_Q_Libro_Listar]';

   -- Declaración de bloque con Handler para manejo de SQLException
   DECLARE EXIT HANDLER FOR SQLEXCEPTION
   Handler_SqlException:
   BEGIN
      ROLLBACK;
      SET pMensajeError = CONCAT('Ocurrió un error al ejecutar el procedimiento. Lógica ', cNombre_Logica);
	  LEAVE Handler_SqlException;
   END;
   
   -- Ejecutar la Consulta
SELECT 
    numero_referencia,isbn,titulo,tema,autor
	FROM
    libros;
END$$


-- --------------------------------------------------------------------------------
-- Routine DDL
-- Note: CONSULTA REGISTRO MESA POR ID
-- --------------------------------------------------------------------------------
DELIMITER $$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Q_Libro_Registro`(pNumero_referencia INT, INOUT pMensajeError VARCHAR(2000))
BEGIN
     
   -- Declaración de variables locales
   DECLARE cNombre_Logica VARCHAR(30) DEFAULT 'Lógica [sp_Q_Libro_Registro]';

   -- Declaración de bloque con Handler para manejo de SQLException
   DECLARE EXIT HANDLER FOR SQLEXCEPTION
   Handler_SqlException:
   BEGIN
      ROLLBACK;
      SET pMensajeError = CONCAT('Ocurrió un error al ejecutar el procedimiento. Lógica ', cNombre_Logica);
	  LEAVE Handler_SqlException;
   END;
   
   -- Ejecutar la Consulta
SELECT 
    numero_referencia,isbn,titulo,tema,autor
	FROM
    libros
	WHERE
	numero_referencia=pNumero_referencia;
   
END$$

-- --------------------------------------------------------------------------------
-- Routine DDL
-- Note: ACTUALIZAR libro
-- --------------------------------------------------------------------------------
DELIMITER $$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_U_Libro`(pNumreferencia INT, pIsbn varchar(45),pTitulo VARCHAR(120),pTema text, pAutor varchar(45),
								 INOUT pMensajeError VARCHAR(2000))
bloquePrincipal:
BEGIN
     
   -- Declaración de variables locales
   DECLARE vCantidad_Registros INT;
   DECLARE vError INT;
   DECLARE cNombre_Logica VARCHAR(30) DEFAULT 'Lógica [sp_U_Libro]';

   -- Declaración de bloque con Handler para manejo de SQLException
   DECLARE EXIT HANDLER FOR SQLEXCEPTION
   Handler_SqlException:
   BEGIN
      ROLLBACK;
      SET pMensajeError = CONCAT('Ocurrió un error al ejecutar el procedimiento. Lógica ', cNombre_Logica);
	  LEAVE Handler_SqlException;
   END; 

   -- Declaración de inicio de Transacción - @@autocommit = 0
   START TRANSACTION;
   
   -- Asignaciones de valores a variables locales
   SET vCantidad_Registros = 0;
   SET pMensajeError = "";
   
   -- Verificar que el usuario exista
   SET vCantidad_Registros = 0;
SELECT 
    COUNT(1)
INTO vCantidad_Registros FROM
    libros
WHERE
    numero_referencia = pNumreferencia;
   
   IF (vCantidad_Registros <= 0) THEN
      SET pMensajeError = CONCAT('El libro no existe. ', cNombre_Logica);
	  ROLLBACK;
	  LEAVE bloquePrincipal;
   END IF;
   
 SET vCantidad_Registros = 0;
  -- verificar q el codigo no se repita 
SELECT 
    COUNT(1)
INTO vCantidad_Registros FROM
    libros
WHERE
    isbn = pIsbn and  numero_referencia <> pNumreferencia;

 IF (vCantidad_Registros >= 1) THEN
      SET pMensajeError = CONCAT('El numero isbn YA existe . ', cNombre_Logica);
	  ROLLBACK;
	  LEAVE bloquePrincipal;
   END IF;
   
   
  -- Ejecutar la actualizacion
	UPDATE libros 
SET 
	isbn=pIsbn,
    titulo = pTitulo,
	tema = pTema,
    autor = pAutor
WHERE
    numero_referencia = pNumreferencia;
   
   SET vError = (SELECT @error_count);
   
   IF (vError > 0) THEN
      ROLLBACK;
      SET pMensajeError = CONCAT('Ocurrió un error al ejecutar el procedimiento. No se actualizó el registro. ', cNombre_Logica);   
   ELSE
      COMMIT;
   END IF;
   
END$$

-- --------------------------------------------------------------------------------
-- Routine DDL
-- INSERT DE lirbro
-- --------------------------------------------------------------------------------

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_I_Libro`(pIsbn varchar(45),pTitulo VARCHAR(120),pTema text, pAutor varchar(45), INOUT pMensajeError VARCHAR(2000))
bloquePrincipal:
BEGIN
     
   -- Declaración de variables locales
   DECLARE vCantidad_Registros INT;
   DECLARE vError INT;
   DECLARE cNombre_Logica VARCHAR(30) DEFAULT 'Lógica [sp_I_Libro]';

   -- Declaración de bloque con Handler para manejo de SQLException
   DECLARE EXIT HANDLER FOR SQLEXCEPTION
   Handler_SqlException:
   BEGIN
      ROLLBACK;
      SET pMensajeError = CONCAT('Ocurrió un error al ejecutar el procedimiento. ', cNombre_Logica);
	  LEAVE Handler_SqlException;
   END; 

   -- Declaración de inicio de Transacción - @@autocommit = 0
   START TRANSACTION;
   
   -- Asignaciones de valores a variables locales
   SET vCantidad_Registros = 0;
   SET pMensajeError = "";
   
   SET vCantidad_Registros = 0;
   
  -- verificar q el codigo no se repita 
SELECT 
    COUNT(1)
INTO vCantidad_Registros FROM
    libros
WHERE
    isbn = pIsbn;

 IF (vCantidad_Registros >= 1) THEN
      SET pMensajeError = CONCAT('El numero isbn YA existe . ', cNombre_Logica);
	  ROLLBACK;
	  LEAVE bloquePrincipal;
   END IF;
   
   -- Insertar en la tabla de Usuario
   INSERT INTO libros(isbn,titulo,tema,autor) 
   VALUES (pIsbn,pTitulo,pTema,pAutor);
   
   SET vError = (SELECT @error_count);
   
   IF (vError > 0) THEN
      ROLLBACK;
      SET pMensajeError = CONCAT('Ocurrió un error al ejecutar el procedimiento. No se pudo insertar el registro. ', cNombre_Logica);   
   ELSE
      COMMIT;
   END IF;
   
END$$