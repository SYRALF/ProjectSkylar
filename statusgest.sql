CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `usuario` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `contabilidad` (
  `idContabilidad` int(11) NOT NULL,
  `fecha` date COLLATE utf8_spanish_ci NOT NULL,
  `servicio` varchar(50) COLLATE utf8_spanish_ci NULL,
  `detalle` varchar(50) COLLATE utf8_spanish_ci NULL,
  `tipo` varchar(50) COLLATE utf8_spanish_ci NOT NULL, 
  `precio` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `factura` (
  `idFactura` int(11) NOT NULL,
  `fecha` date COLLATE utf8_spanish_ci NOT NULL,
  `fechaVencimiento` date COLLATE utf8_spanish_ci NOT NULL,
  `cliente` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(11) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL, 
  `precioUnitario` decimal(10,2) COLLATE utf8_spanish_ci NOT NULL, 
  `importe` decimal(10,2) COLLATE utf8_spanish_ci NOT NULL,
  `total` decimal(10,2) COLLATE utf8_spanish_ci NOT NULL,
  `fk_cliente` int(11) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL,  
  `cedula` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` int(11) COLLATE utf8_spanish_ci NULL,
  `direccion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `usuario` (`id`, `usuario`, `password`) VALUES
(1, 'admin', 'administrador2022');

ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `contabilidad`
  ADD PRIMARY KEY (`idContabilidad`);

ALTER TABLE `contabilidad`
  MODIFY `idContabilidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`),
  ADD UNIQUE KEY `cedula` (`cedula`);

ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


ALTER TABLE `factura`
  ADD PRIMARY KEY (`idFactura`),ADD FOREIGN KEY (fk_cliente) REFERENCES cliente(idCliente);

ALTER TABLE `factura`
  MODIFY `idFactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;