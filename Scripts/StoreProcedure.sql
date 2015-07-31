Use biblioteca;
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
