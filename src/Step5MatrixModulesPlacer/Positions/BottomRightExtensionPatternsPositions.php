<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions;

class BottomRightExtensionPatternsPositions extends AbstractVersionDependentPositions
{
    public function getPositions(): \Generator
    {
        for ($col = 0; $col < 2; $col++) {
            for ($row = 0; $row < 2; $row++) {
                yield new Position($col, $row);
            }
        }
    }
}
