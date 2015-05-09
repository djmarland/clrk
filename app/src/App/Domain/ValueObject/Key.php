<?php

namespace App\Domain\ValueObject;

class Key
{
    const ID_INFLATION_MULTIPLIER = 20;
    const ALLOWED_CHARACTERS = '23456789bcdfghjklmnpqrstvwxz';

    private $key;

    private $prefix;

    public function __construct(
        $key,
        $prefix = null
    ) {
        if (is_int($key)) {
            $key = $this->idToKey($key, $prefix);
        }
        $this->key = $key;
        $this->prefix = reset($key);
    }

    public function __toString()
    {
        return $this->getKey();
    }

    public function getKey()
    {
        return $this->key;
    }

    public function getPrefix()
    {
        return $this->prefix;
    }

    public function getId()
    {
        return $this->keyToId();
    }

    /**
     * @param int $id
     * @param string $prefix
     * @return string
     */
    protected function idToKey($id, $prefix = '')
    {
        $characters = self::ALLOWED_CHARACTERS;

        $base = strlen($characters);
        $id = $id + static::ID_INFLATION_MULTIPLIER;
        $key = '';
        if ($id == 0) {
            $key = $characters[0];
        } else {
            while ($id > 0) {
                // modulus cannot support high int values. must use float instead
                $newid = floor($id / $base);
                $key = $characters[(int) ($id - ($newid*$base))] . $key;
                $id = $newid;
            }
        }
        return strtolower($prefix . ':0' . str_pad($key, 2, '0', STR_PAD_LEFT));
    }

    /**
     * @return int
     */
    protected function keyToId()
    {
        $key = $this->key;
        $prefix = substr($key,0,1);

        $key = strtolower($key);
        $key = str_replace(array('0',':'),'',$key);
        $base = strlen(self::ALLOWED_CHARACTERS);
        $key = array_reverse(str_split(substr($key,strlen($prefix))));
        $id = 0;
        $power = 0;
        foreach ($key as $letter) {
            $id = $id + (strpos(self::ALLOWED_CHARACTERS,$letter) * pow($base,$power));
            $power++;
        }
        $id = $id - static::ID_INFLATION_MULTIPLIER;
        return $id;
    }
}
