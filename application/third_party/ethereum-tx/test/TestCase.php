<<<<<<< HEAD
<?php

namespace Test;

use \PHPUnit\Framework\TestCase as BaseTestCase;
use Web3p\RLP\RLP;

class TestCase extends BaseTestCase
{
    /**
     * rlp
     * 
     * @var \Web3p\RLP\RLP
     */
    protected $rlp;

    /**
     * testPrivateKey
     * 
     * @var string
     */
    protected $testPrivateKey = '0xd0459987fdde1f41e524fddbf4b646cd9d3bea7fd7d63feead3f5dfce6174a3d';

    /**
     * setUp
     * 
     * @return void
     */
    public function setUp()
    {
        $this->rlp = new RLP;
    }

    /**
     * tearDown
     * 
     * @return void
     */
    public function tearDown() {}
=======
<<<<<<< HEAD
<?php

namespace Test;

use \PHPUnit\Framework\TestCase as BaseTestCase;
use Web3p\RLP\RLP;

class TestCase extends BaseTestCase
{
    /**
     * rlp
     * 
     * @var \Web3p\RLP\RLP
     */
    protected $rlp;

    /**
     * testPrivateKey
     * 
     * @var string
     */
    protected $testPrivateKey = '0xd0459987fdde1f41e524fddbf4b646cd9d3bea7fd7d63feead3f5dfce6174a3d';

    /**
     * setUp
     * 
     * @return void
     */
    public function setUp()
    {
        $this->rlp = new RLP;
    }

    /**
     * tearDown
     * 
     * @return void
     */
    public function tearDown() {}
=======
<?php

namespace Test;

use \PHPUnit\Framework\TestCase as BaseTestCase;
use Web3p\RLP\RLP;

class TestCase extends BaseTestCase
{
    /**
     * rlp
     * 
     * @var \Web3p\RLP\RLP
     */
    protected $rlp;

    /**
     * testPrivateKey
     * 
     * @var string
     */
    protected $testPrivateKey = '0xd0459987fdde1f41e524fddbf4b646cd9d3bea7fd7d63feead3f5dfce6174a3d';

    /**
     * setUp
     * 
     * @return void
     */
    public function setUp()
    {
        $this->rlp = new RLP;
    }

    /**
     * tearDown
     * 
     * @return void
     */
    public function tearDown() {}
>>>>>>> db6fde4a1ca71cfd4df0fc7842e417dabdfda373
>>>>>>> 11d9bc3a6414f2ab27633809a47f053080ba970e
}